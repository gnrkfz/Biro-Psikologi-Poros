<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Mpdf\Mpdf;
use App\Models\Klien;
use App\Models\User;
use App\Models\Test;
use App\Models\FormTes;
use App\Models\TesKecerdasan;
use App\Models\TesKecermatan;
use App\Models\JawabanTesKecerdasan;
use App\Models\JawabanTesKecermatan;
use App\Models\SubSoalTesKecermatan;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $tests = Test::orderBy('id', 'desc')->get();
        return view('admin.dashboard', compact('tests', 'user'));
    }

    public function adminsettings()
    {
        $user = Auth::user();
        return view('admin.adminsettings', compact('user'));
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The old password does not match with current password.']);
        }
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('admin.dashboard')->with('updatepasswordsuccess', 'Kata sandi berhasil diperbarui.');
    }

    public function tambahadmin(Request $request)
    {
        return view('admin.tambahadmin');
    }

    public function createadmin(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ]);
        return redirect()->route('admin.dashboard')->with('createadminsuccess', 'Akun berhasil ditambahkan.');
    }

    public function tambahteskecerdasan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);
        $existingTest = Test::where('judul', $request->input('judul'))->first();
        if ($existingTest) {
            return redirect()->route('admin.dashboard')->with('tambahtesfailed', 'Failed!');
        }
        $test = new Test;
        $test->judul = $request->input('judul');
        $test->jenis = 'Tes Kecerdasan';
        $test->save();
        return redirect()->route('admin.dashboard')->with('tambahtessuccess', 'Added!');
    }

    public function deletetest($id)
    {
        $test = Test::find($id);
        if ($test->jenis == "Tes Kecerdasan") {
            TesKecerdasan::where('idtest', $test->id)->update(['idtest' => 999999]);
        } else if ($test->jenis == "Tes Kecermatan") {
            TesKecermatan::where('idtest', $test->id)->delete();
        }
        $test->delete();
        return redirect()->route('admin.dashboard');
    }

    public function teskecerdasan($id)
    {
        $test = Test::find($id);
        $soals = TesKecerdasan::where('idtest', $id)->orderBy('kategori')->orderBy('level')->get();
        $jumlahSoal = [
            'Aritmatika' => [
                'Level 1' => $soals->where('kategori', 'Aritmatika')->where('level', 1)->count(),
                'Level 2' => $soals->where('kategori', 'Aritmatika')->where('level', 2)->count(),
                'Level 3' => $soals->where('kategori', 'Aritmatika')->where('level', 3)->count(),
            ],
            'Logis' => [
                'Level 1' => $soals->where('kategori', 'Logis')->where('level', 1)->count(),
                'Level 2' => $soals->where('kategori', 'Logis')->where('level', 2)->count(),
                'Level 3' => $soals->where('kategori', 'Logis')->where('level', 3)->count(),
            ],
            'Non Verbal' => [
                'Level 1' => $soals->where('kategori', 'Non Verbal')->where('level', 1)->count(),
                'Level 2' => $soals->where('kategori', 'Non Verbal')->where('level', 2)->count(),
                'Level 3' => $soals->where('kategori', 'Non Verbal')->where('level', 3)->count(),
            ],
            'Verbal' => [
                'Level 1' => $soals->where('kategori', 'Verbal')->where('level', 1)->count(),
                'Level 2' => $soals->where('kategori', 'Verbal')->where('level', 2)->count(),
                'Level 3' => $soals->where('kategori', 'Verbal')->where('level', 3)->count(),
            ],
        ];
        return view('admin.teskecerdasan', compact('test', 'id', 'soals', 'jumlahSoal'));
    }

    public function tambahsoalteskecerdasan(Request $request)
    {
        $teskecerdasan = new TesKecerdasan;
        $teskecerdasan->idtest = $request->input('idtest');
        $teskecerdasan->pertanyaan = $request->input('pertanyaan');
        if ($request->hasFile('gambarsoal')) {
            $imagePath = $request->file('gambarsoal')->store('gambarsoal', 'public');
            $teskecerdasan->gambarsoal = $imagePath;
        }
        $teskecerdasan->opsi1 = $request->input('opsi1');
        $teskecerdasan->opsi2 = $request->input('opsi2');
        $teskecerdasan->opsi3 = $request->input('opsi3');
        $teskecerdasan->opsi4 = $request->input('opsi4');
        $teskecerdasan->opsi5 = $request->input('opsi5');
        $teskecerdasan->jawabanbenar = $request->input('jawabanbenar');
        $teskecerdasan->kategori = $request->input('kategori');
        $teskecerdasan->level = $request->input('level');
        $teskecerdasan->save();
        $test = Test::where('id', $request->input('idtest'))->first();
        $test->updated_at = now();
        $test->save();
        return redirect()->route('teskecerdasan', ['id' => $request->input('idtest')]);
    }

    public function detailsoalteskecerdasan($id)
    {
        $soal = TesKecerdasan::find($id);
        $idtest = $soal->idtest;
        $test = Test::where('id', $idtest)->first();
        return view('admin.detailsoalteskecerdasan', compact('soal', 'test'));
    }

    public function editsoalteskecerdasan(Request $request, $id)
    {
        $teskecerdasan = TesKecerdasan::find($id);
        $teskecerdasan->idtest = $request->input('idtest');
        $teskecerdasan->pertanyaan = $request->input('pertanyaan');
        if ($request->hasFile('gambarsoal')) {
            $oldImagePath = $teskecerdasan->gambarsoal;
            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
            $imagePath = $request->file('gambarsoal')->store('gambarsoal', 'public');
            $teskecerdasan->gambarsoal = $imagePath;
        }
        $teskecerdasan->opsi1 = $request->input('opsi1');
        $teskecerdasan->opsi2 = $request->input('opsi2');
        $teskecerdasan->opsi3 = $request->input('opsi3');
        $teskecerdasan->opsi4 = $request->input('opsi4');
        $teskecerdasan->opsi5 = $request->input('opsi5');
        $teskecerdasan->jawabanbenar = $request->input('jawabanbenar');
        $teskecerdasan->kategori = $request->input('kategori');
        $teskecerdasan->level = $request->input('level');
        $teskecerdasan->save();
        return redirect()->route('teskecerdasan', ['id' => $request->input('idtest')]);
    }

    public function deletesoalkecerdasan($id)
    {
        $soal = TesKecerdasan::find($id);
        $idtest = $soal->idtest;
        $soal->idtest = 999999;
        $soal->save();
        return redirect()->route('teskecerdasan', ['id' => $idtest]);
    }

    public function tambahteskecermatan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
        ]);
        $existingTest = Test::where('judul', $request->input('judul'))->first();
        if ($existingTest) {
            return redirect()->route('admin.dashboard')->with('tambahtesfailed', 'Failed!');
        }
        $test = new Test;
        $test->judul = $request->input('judul');
        $test->jenis = 'Tes Kecermatan';
        $test->save();
        return redirect()->route('admin.dashboard')->with('tambahtessuccess', 'Added!');
    }

    public function teskecermatan($id)
    {
        $test = Test::find($id);
        $soals = TesKecermatan::where('idtest', $id)->get();
        $jumlahSoal = $soals->count();
        return view('admin.teskecermatan', compact('test', 'id', 'soals', 'jumlahSoal'));
    }

    public function tambahsoalteskecermatan(Request $request)
    {
        $teskecermatan = new TesKecermatan;
        $teskecermatan->idtest = $request->input('idtest');
        $teskecermatan->kar1 = $request->input('kar1');
        $teskecermatan->kar2 = $request->input('kar2');
        $teskecermatan->kar3 = $request->input('kar3');
        $teskecermatan->kar4 = $request->input('kar4');
        $teskecermatan->kar5 = $request->input('kar5');
        $kars = [$teskecermatan->kar1, $teskecermatan->kar2, $teskecermatan->kar3, $teskecermatan->kar4, $teskecermatan->kar5];
        if (count($kars) !== count(array_unique($kars))) {
            return redirect()->route('teskecermatan', ['id' => $request->input('idtest')])->with('karerror', 'Karakter 1 sampai 5 harus berbeda. Silakan coba lagi.');
        }
        $teskecermatan->save();
        for ($i = 1; $i <= 50; $i++) {
            shuffle($kars);
            $SubSoalTesKecermatan = new SubSoalTesKecermatan;
            $SubSoalTesKecermatan->idsoal = $teskecermatan->id;
            $SubSoalTesKecermatan->kar1 = $kars[0];
            $SubSoalTesKecermatan->kar2 = $kars[1];
            $SubSoalTesKecermatan->kar3 = $kars[2];
            $SubSoalTesKecermatan->kar4 = $kars[3];
            $SubSoalTesKecermatan->karhilang = $kars[4];
            $SubSoalTesKecermatan->save();
        }
        $test = Test::where('id', $request->input('idtest'))->first();
        $test->updated_at = now();
        $test->save();
        return redirect()->route('teskecermatan', ['id' => $request->input('idtest')]);
    }

    public function deletesoalkecermatan($id)
    {
        $soal = TesKecermatan::find($id);
        $idtest = $soal->idtest;
        try {
            SubSoalTesKecermatan::where('idsoal', $id)->delete();
            TesKecermatan::findOrFail($id)->delete();
            return redirect()->route('teskecermatan', ['id' => $idtest]);
        } catch (\Exception $e) {
            return redirect()->route('teskecermatan', ['id' => $idtest]);
        }
    }

    public function daftarklien()
    {
        $kliens = Klien::orderBy('id', 'desc')->get();
        return view('admin.daftarklien', compact('kliens'));
    }

    public function tambahklien(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $user = new User;
        $user->nama = $request->input('nama');
        $user->save();
        $user->email = 'klien' . $user->id . '@klien.com';
        $user->password = bcrypt('klien' . $user->id);
        $user->role = 'klien';
        $user->save();
        $klien = new Klien;
        $klien->id = $user->id;
        $klien->nama = $request->input('nama');
        $klien->save();
        return redirect()->route('admin.daftarklien')->with('tambahkliensuccess', 'Added!');
    }

    public function detailklien($id)
    {
        $klien = Klien::find($id);
        $dataTes = FormTes::join('test', 'formtes.idtest', '=', 'test.id')->where('formtes.idklien', $id)->select('formtes.*', 'test.judul as judul')->get();
        return view('admin.detailklien', ['klien' => $klien], ['dataTes' => $dataTes]);
    }

    public function editklien(Request $request)
    {
        $klien = Klien::find($request->input('idklien'));
        $klien->jeniskelamin = $request->input('jeniskelamin');
        $klien->tanggallahir = $request->input('tanggallahir');
        $klien->email = strtolower($request->input('email'));
        $klien->nomortelepon = $request->input('nomortelepon');
        $klien->alamat = $request->input('alamat');
        $klien->kota = $request->input('kota');
        $klien->instansi = $request->input('instansi');
        $klien->pendidikanterakhir = $request->input('pendidikanterakhir');
        $klien->keperluan = $request->input('keperluan');
        $klien->save();
        return redirect()->route('detailklien', ['id' => $request->input('idklien')])->with('editkliensuccess', 'Success!');
    }

    public function deleteklien($id)
    {
        $jawabanteskecerdasan = JawabanTesKecerdasan::where('idklien', $id)->delete();
        $jawabanteskecermatan = JawabanTesKecermatan::where('idklien', $id)->delete();
        $formtes =  FormTes::where('idklien', $id)->delete();
        $klien = Klien::find($id)->delete();
        $user = User::find($id)->delete();
        return redirect()->route('admin.daftarklien');
    }

    public function formtes($id)
    {
        $klien = Klien::findOrFail($id);
        $validTests = collect();
        $tests = Test::all();
        foreach ($tests as $test) {
            if ($test->jenis == 'Tes Kecerdasan') {
                $count = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->count();
                $countAritmatika = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Aritmatika')
                    ->count();
                $countAritmatikaLevel1 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Aritmatika')
                    ->where('level', 1)
                    ->count();
                $countAritmatikaLevel2 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Aritmatika')
                    ->where('level', 2)
                    ->count();
                $countAritmatikaLevel3 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Aritmatika')
                    ->where('level', 3)
                    ->count();
                $countLogis = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Logis')
                    ->count();
                $countLogisLevel1 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Logis')
                    ->where('level', 1)
                    ->count();
                $countLogisLevel2 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Logis')
                    ->where('level', 2)
                    ->count();
                $countLogisLevel3 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Logis')
                    ->where('level', 3)
                    ->count();
                $countNonVerbal = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Non Verbal')
                    ->count();
                $countNonVerbalLevel1 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Non Verbal')
                    ->where('level', 1)
                    ->count();
                $countNonVerbalLevel2 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Non Verbal')
                    ->where('level', 2)
                    ->count();
                $countNonVerbalLevel3 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Non Verbal')
                    ->where('level', 3)
                    ->count();
                $countVerbal = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Verbal')
                    ->count();
                $countVerbalLevel1 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Verbal')
                    ->where('level', 1)
                    ->count();
                $countVerbalLevel2 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Verbal')
                    ->where('level', 2)
                    ->count();
                $countVerbalLevel3 = DB::table('teskecerdasan')
                    ->where('idtest', $test->id)
                    ->where('kategori', 'Verbal')
                    ->where('level', 3)
                    ->count();
                if (
                    $count >= 100 &&
                    $countAritmatika >= 25 && $countAritmatikaLevel1 >= 12 && $countAritmatikaLevel2 >= 7 && $countAritmatikaLevel3 >= 6 &&
                    $countLogis >= 25 && $countLogisLevel1 >= 12 && $countLogisLevel2 >= 7 && $countLogisLevel3 >= 6 &&
                    $countNonVerbal >= 25 && $countNonVerbalLevel1 >= 12 && $countNonVerbalLevel2 >= 7 && $countNonVerbalLevel3 >= 6 &&
                    $countVerbal >= 25 && $countVerbalLevel1 >= 12 && $countVerbalLevel2 >= 7 && $countVerbalLevel3 >= 6
                ) {
                    $validTests->push($test);
                }
            } elseif ($test->jenis == 'Tes Kecermatan') {
                $count = DB::table('teskecermatan')
                            ->where('idtest', $test->id)
                            ->count();
                if ($count >= 10) {
                    $validTests->push($test);
                }
            }
        }
        return view('admin.formtes', ['klien' => $klien, 'tests' => $validTests]);
    }

    public function tambahformtes(Request $request)
    {
        $idklien = $request->idklien;
        $klien = Klien::find($idklien);
        $tanggaltes = \Carbon\Carbon::createFromFormat('d-m-Y', $request->tanggaltes)->format('Y-m-d');
        for ($i = 1; $i <= $request->testcounter; $i++) {
            $formTes = new FormTes();
            $formTes->idklien = $idklien;
            $formTes->idtest = $request->{"test$i"};
            $test = Test::find($formTes->idtest);
            $formTes->judultest = $test->judul;
            $formTes->jenistest = $test->jenis;
            $formTes->tanggaltes = $tanggaltes;
            $formTes->status = 'Belum Dikerjakan';
            $formTes->save();
            $klien->updated_at = now();
            $klien->save();
        }
        return redirect()->route('detailklien', ['id' => $idklien])->with('addformtestsuccess', 'Added!');
    }

    public function deleteformtes($id)
    {
        $formtes = FormTes::find($id);
        $klien = Klien::find($formtes->idklien);
        $formtes->delete();
        return redirect()->route('detailklien', ['id' => $klien->id]);
    }

    public function detailriwayattes($id)
    {
        $formtes = FormTes::find($id);
        $klien = Klien::find($formtes->idklien);
        if ($formtes->jenistest == "Tes Kecerdasan") {
            $jawabanteskecerdasan = JawabanTesKecerdasan::where('idformtes', $formtes->id)->get();
            return view('admin.detailriwayattes', compact('formtes', 'klien', 'jawabanteskecerdasan'));
        } elseif ($formtes->jenistest == "Tes Kecermatan") {
            $jawabanteskecermatan = JawabanTesKecermatan::where('idformtes', $formtes->id)->get();
            $nilaiteskecermatan = JawabanTesKecermatan::where('idformtes', $formtes->id)
            ->whereIn('sesi', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
            ->get(['benar', 'salah']);
            $dataBenar = [];
            $dataTerjawab = [];
            foreach ($nilaiteskecermatan as $jawaban) {
                $dataBenar[] = $jawaban->benar;
                $dataTerjawab[] = $jawaban->benar + $jawaban->salah;
            }
            $chart = (new LarapexChart)->lineChart()
                ->addData('Benar', $dataBenar)
                ->addData('Soal Terjawab', $dataTerjawab)
                ->setColors(['#00FF00', '#000000'])
                ->setXAxis(['Sesi 1', 'Sesi 2', 'Sesi 3', 'Sesi 4', 'Sesi 5', 'Sesi 6', 'Sesi 7', 'Sesi 8', 'Sesi 9', 'Sesi 10']);
            return view('admin.detailriwayattes', compact('formtes', 'klien', 'jawabanteskecermatan', 'chart'));
        }
    }

    public function jawabanteskecerdasan($idformtes)
    {
        $formtes = FormTes::find($idformtes);
        $klien = Klien::find($formtes->idklien);
        $jawabanteskecerdasan = JawabanTesKecerdasan::where('idformtes', $idformtes)->get();
        $idsoalArray = $jawabanteskecerdasan->pluck('idsoal')->toArray();
        $soal = TesKecerdasan::whereIn('id', $idsoalArray)->orderByRaw("FIELD(id, " . implode(",", $idsoalArray) . ")")->get();
        return view('admin.jawabanteskecerdasan', compact('formtes', 'soal', 'jawabanteskecerdasan', 'klien'));
    }

    public function cetaknilaiteskecerdasan($idformtes)
    {
        $formtes = FormTes::find($idformtes);
        $klien = Klien::find($formtes->idklien);
        $jawabanteskecerdasan = JawabanTesKecerdasan::where('idformtes', $idformtes)->get();
        $idsoalArray = $jawabanteskecerdasan->pluck('idsoal')->toArray();
        $soals = TesKecerdasan::whereIn('id', $idsoalArray)->orderByRaw("FIELD(id, " . implode(",", $idsoalArray) . ")")->get();
        $html1 = view('admin.pdfteskecerdasan1', compact('formtes', 'jawabanteskecerdasan', 'klien'))->render();
        $html2 = view('admin.pdfteskecerdasan2', compact('formtes', 'jawabanteskecerdasan', 'klien', 'soals'))->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html1);
        $mpdf->AddPage();
        $mpdf->WriteHTML($html2);
        $mpdf->Output();
    }

    public function cetaknilaiteskecermatan($idformtes)
    {
        $formtes = FormTes::find($idformtes);
        $klien = Klien::find($formtes->idklien);
        $jawabanteskecermatan = JawabanTesKecermatan::where('idformtes', $idformtes)->get();
        $html = view('admin.pdfteskecermatan', compact('formtes', 'jawabanteskecermatan', 'klien'))->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}

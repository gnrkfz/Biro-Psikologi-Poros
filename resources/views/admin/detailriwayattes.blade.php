<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Panel</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100">
        <!-- NAVBAR -->
        <nav class="bg-white border-gray-200 shadow-md">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="/admin/dashboard" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-black">Biro Psikologi Poros</span>
                </a>
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="/admin/dashboard" class="block py-2 px-4 text-black rounded hover:text-blue-800">Layanan</a>
                    </li>
                    <li>
                        <a href="/admin/daftarklien" class="block py-2 px-4 text-blue-700 hover:text-blue-800 rounded" aria-current="page">Klien</a>
                    </li>
                    <li>
                        <a onclick="showLogoutConfirmation()" class="block py-2 px-4 text-black rounded hover:text-red-900 cursor-pointer">Keluar</a>
                    </li>
                </ul>
            </div>
        </nav>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function showLogoutConfirmation() {
                Swal.fire({
                    text: 'Apakah anda yakin ingin keluar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1d4ed8',
                    cancelButtonColor: '#b91c1c',
                    confirmButtonText: 'Ya, Keluar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/logout";
                    }
                });
            };
        </script>

        <!-- CONTENT -->
        <div class="bg-white my-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
            <a href="#" onclick="history.back();" class="text-black">
                <span class="text-xl">&larr;</span> Back
            </a>
            <h1 class="text-2xl font-semibold mb-10 text-center">Detail Riwayat Tes</h1>
            <div class="flex grid-cols-4 mb-5">
                <div class="w-1/3">
                    <h2 class="flex font-medium text-md mb-2.5">ID Form Tes</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Nama Tes</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Jumlah Soal</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Waktu</h2>
                </div>
                <div class="w-2/3">
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $formtes->id }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $formtes->judultest }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: 
                    @if($formtes->jenistest === 'Tes Kecerdasan')
                        100 Soal
                    @elseif($formtes->jenistest === 'Tes Kecermatan')
                        50 Soal x 10 Sesi
                    @endif
                    </h2>
                    <h2 class="flex font-medium text-md mb-2.5">: 
                    @if($formtes->jenistest === 'Tes Kecerdasan')
                        80 Menit
                    @elseif($formtes->jenistest === 'Tes Kecermatan')
                        1 Menit / Sesi
                    @endif
                    </h2>
                </div>
                <div class="w-1/3">
                    <h2 class="flex font-medium text-md mb-2.5">Nama Klien</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Tanggal Tes</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Status</h2>
                </div>
                <div class="w-2/3">
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->nama }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ date('d-m-Y', strtotime($formtes->tanggaltes)) }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">:&nbsp;
                    <span class="text-white font-normal {{ $formtes->status === 'Sudah Dikerjakan' ? 'bg-green-700 px-1 rounded' : 'bg-red-700 px-1 rounded' }}">{{ $formtes->status }}</span>
                    </h2>
                </div>
            </div>
            @if($formtes->jenistest == 'Tes Kecerdasan')
            <h2 class="flex font-medium text-md mb-2.5">Total Soal Terjawab : {{ $jawabanteskecerdasan->where('idformtes', $formtes->id)->where('benarsalah', '!=', 'Tak Terjawab')->count() }}</h2>
            <table class="w-full text-sm mb-5">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/6"></th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/6">Aritmatika</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/6">Logis</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/6">Verbal</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/6">Non Verbal</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/6">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Benar</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Aritmatika')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Logis')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Verbal')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Non Verbal')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->count() }}</th>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Salah</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Aritmatika')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Logis')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Verbal')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Non Verbal')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->count() }}</th>
                    </tr>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Tak Terjawab</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Aritmatika')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Logis')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Verbal')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Non Verbal')->count() }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->count() }}</th>
                    </tr>
                </tbody>
            </table>
            <div class="flex grid-cols-2 justify-center gap-x-10">
                <div class="w-1/2">
                    <h2 class="flex font-medium text-md mb-2.5">Kemampuan Aritmatika</h2>
                    <table class="text-sm w-full mb-5">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4"></th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 1</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 2</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Benar</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Salah</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Tak Terjawab</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Aritmatika')->count() }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="w-1/2">
                    <h2 class="flex font-medium text-md mb-2.5">Berpikir Logis</h2>
                    <table class="text-sm w-full mb-5">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4"></th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 1</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 2</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Benar</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Logis')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Logis')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Logis')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Salah</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Logis')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Logis')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Logis')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Tak Terjawab</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Logis')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Logis')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Logis')->count() }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex grid-cols-2 justify-center gap-x-10 mb-2.5">
                <div class="w-1/2">
                    <h2 class="flex font-medium text-md mb-2.5">Kemampuan Verbal</h2>
                    <table class="text-sm w-full mb-5">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4"></th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 1</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 2</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Benar</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Verbal')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Salah</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Verbal')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Tak Terjawab</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Verbal')->count() }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="w-1/2">
                    <h2 class="flex font-medium text-md mb-2.5">Kemampuan Analisa Non Verbal</h2>
                    <table class="text-sm w-full mb-5">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4"></th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 1</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 2</th>
                                <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Level 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Benar</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Salah</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border-2 border-gray-400 font-bold text-md">Tak Terjawab</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                                <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Non Verbal')->count() }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ route('jawabanteskecerdasan', ['id' => $formtes->id]) }}" class="py-2 px-3 mr-2.5 bg-blue-700 hover:bg-blue-800 transition duration-100 ease-in-out text-white rounded">Lihat Jawaban Klien</a>
            <a href="{{ route('cetaknilaiteskecerdasan', ['id' => $formtes->id]) }}" target="_blank" class="py-2 px-3 ml-2.5 bg-blue-700 hover:bg-blue-800 transition duration-100 ease-in-out text-white rounded">Cetak Nilai Klien</a>
            @elseif($formtes->jenistest == 'Tes Kecermatan')
            <h2 class="flex font-medium text-md mb-2.5">Statistik Nilai Per Sesi</h2>
            <div class="flex">
                <div class="w-2/3 mr-5 mb-5">
                    {!! $chart->container() !!}
                </div>
                <div class="flex grid-cols-2 ml-5 w-1/3">
                    <div class="w-1/5 h-fit">
                        <h2 class="font-normal text-md mb-2.5">Sesi 1</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 2</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 3</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 4</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 5</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 6</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 7</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 8</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 9</h2>
                        <h2 class="font-normal text-md mb-2.5">Sesi 10</h2>
                    </div>
                    <div class="h-fit mr-10">
                    @php
                        $totalNilai = 0;
                        $totalTerjawab = 0;
                    @endphp
                    @foreach ($jawabanteskecermatan as $jawaban)
                        @php
                            $totalNilai += $jawaban->benar;
                            $totalTerjawab += $jawaban->benar;
                            $totalTerjawab += $jawaban->salah;
                            $totalTerjawabPerSesi = 0;
                            $totalTerjawabPerSesi += $jawaban->benar;
                            $totalTerjawabPerSesi += $jawaban->salah;
                        @endphp
                        <h2 class="font-normal text-md mb-2.5">: {{ $jawaban->benar }} / {{ $totalTerjawabPerSesi }}</h2>
                    @endforeach
                    </div>
                    <div>
                    <h2 class="ml-20 font-medium text-md mb-2.5">Total Nilai : {{ $totalNilai }}</h2>
                    <h2 class="ml-20 font-medium text-md mb-2.5">Total Terjawab : {{ $totalTerjawab }}</h2>
                    </div>
                </div>
            </div>
            <a href="{{ route('cetaknilaiteskecermatan', ['id' => $formtes->id]) }}" target="_blank" class="py-2 px-3 ml-2.5 bg-blue-700 hover:bg-blue-800 transition duration-100 ease-in-out text-white rounded">Cetak Nilai Klien</a>
            @endif
        </div>
        @if($formtes->jenistest == 'Tes Kecermatan')
        <script src="{{ $chart->cdn() }}"></script>
        {{ $chart->script() }}
        @endif
    </body>
</html>
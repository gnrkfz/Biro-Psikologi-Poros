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
                        <a href="/logout" id="logoutButton" class="block py-2 px-4 text-black rounded hover:text-red-900">Keluar</a>
                    </li>
                </ul>
            </div>
        </nav>
        <script>
            function showLogoutConfirmation(event) {
                event.preventDefault();
                var confirmLogout = confirm("Apakah anda yakin ingin keluar?");
                if (confirmLogout) {
                    window.location.href = "/logout";
                }
            }
            document.getElementById("logoutButton").addEventListener("click", showLogoutConfirmation);
        </script>

        <!-- CONTENT -->
        <div class="bg-white my-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
            <a href="/admin/daftarklien" class="text-black">
                <span class="text-xl">&larr;</span> Back
            </a>
            <h1 class="text-2xl font-semibold mb-10 text-center">Detail Klien</h1>
            <div class="flex grid-cols-4 mb-5">
                <div class="w-1/3">
                    <h2 class="flex font-medium text-md mb-2.5">ID Klien</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Nama Lengkap</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Jenis Kelamin</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Tanggal Lahir</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Instansi</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Pendidikan Terakhir</h2>
                </div>
                <div class="w-2/3">
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->id }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->nama }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->jeniskelamin === 'L' ? 'Laki-Laki' : ($klien->jeniskelamin === 'P' ? 'Perempuan' : '') }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->tanggallahir ? date('d-m-Y', strtotime($klien->tanggallahir)) : '' }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->instansi }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->pendidikanterakhir }}</h2>
                </div>
                <div class="w-1/3">
                    <h2 class="flex font-medium text-md mb-2.5">Alamat</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Kota</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Email</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Nomor Telepon</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Keperluan</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Kedatangan Terakhir</h2>
                </div>
                <div class="w-2/3">
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->alamat }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->kota }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->email }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->nomortelepon }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->keperluan }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->kedatanganterakhir ? \Carbon\Carbon::parse($klien->kedatanganterakhir)->format('d-m-Y') : '' }}</h2>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tw-modal" class="cursor-pointer rounded h-fit mr-5 text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 py-2 px-4">
                        Edit Profil
                    </label>
                    <a href="{{ route('formtes', ['id' => $klien->id]) }}" class="cursor-pointer rounded h-fit mr-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">
                        Tambah Tes
                    </a>
                </div>
                <div class="text-right">
                    <a onclick="deleteKlien(event)" class="cursor-pointer rounded h-fit text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 py-2 px-4">
                        Delete
                    </a>
                </div>
            </div>
            <!-- MODAL LENGKAPI DATA DIRI -->
            <input type="checkbox" id="tw-modal" class="peer fixed appearance-none opacity-0">
            <label for="tw-modal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
            <label for="" class="max-h-[calc(100vh)-5em] h-fit w-full max-w-xl scale-90 overflow-y-auto overscroll-contain rounded bg-white py-5 px-10 text-black shadow-lg transition">
                <div class="flex">
                    <a href="{{ route('detailklien', ['id' => $klien->id]) }}" class="text-black ml-auto">
                        <span class="text-xl">×</span>
                    </a>
                </div>
                <h1 class="text-xl font-semibold mb-5 text-center">Edit Profil</h1>
                <form action="{{ route('editklien') }}" method="post">
                    @csrf
                    <input type="hidden" name="idklien" value="{{ $klien->id }}">
                    <div class="grid grid-cols-2 gap-x-5 gap-y-2.5">
                        <div>
                            <label for="nama" class="flex text-black text-md font-semibold mb-2">Nama</label>
                            <input type="text" name="nama" placeholder="{{ $klien->nama }}" class="disabled p-2 border-2 border-gray-400 w-full rounded" value="{{ $klien->nama }}" readonly>
                        </div>
                        <div> 
                            <label for="jeniskelamin" class="flex text-black text-md font-semibold mb-2">Jenis Kelamin</label>
                            <div>
                                <label>
                                    <input type="radio" name="jeniskelamin" value="L" {{ $klien->jeniskelamin == 'L' ? 'checked' : '' }} required>
                                    Laki-laki
                                </label>
                            </div>
                            <div>
                                <label>
                                    <input type="radio" name="jeniskelamin" value="P" {{ $klien->jeniskelamin == 'P' ? 'checked' : '' }} required>
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="tanggallahir" class="flex text-black text-md font-semibold mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggallahir" class="p-2 border-2 border-gray-400 w-full rounded" value="{{ $klien->tanggallahir }}" required></input>
                        </div>
                        <div>
                            <label for="email" class="flex text-black text-md font-semibold mb-2">Email</label>
                            <textarea type="text" name="email" class="p-2 border-2 border-gray-400 w-full rounded" rows="1" required>{{ $klien->email }}</textarea>
                        </div>
                        <div>
                            <label for="nomortelepon" class="flex text-black text-md font-semibold mb-2">No. Telepon</label>
                            <textarea type="text" name="nomortelepon" class="p-2 border-2 border-gray-400 w-full rounded" rows="1" required>{{ $klien->nomortelepon }}</textarea>
                        </div>
                        <div>
                            <label for="alamat" class="flex text-black text-md font-semibold mb-2">Alamat</label>
                            <textarea type="text" name="alamat" class="p-2 border-2 border-gray-400 w-full rounded" rows="1" required>{{ $klien->alamat }}</textarea>
                        </div>
                        <div>
                            <label for="kota" class="flex text-black text-md font-semibold mb-2">Kota</label>
                            <textarea type="text" name="kota" class="p-2 border-2 border-gray-400 w-full rounded" rows="1" required>{{ $klien->kota }}</textarea>
                        </div>
                        <div>
                            <label for="instansi" class="flex text-black text-md font-semibold mb-2">Instansi</label>
                            <textarea type="text" name="instansi" class="p-2 border-2 border-gray-400 w-full rounded" rows="1" required>{{ $klien->instansi }}</textarea>
                        </div>
                        <div>
                            <label for="pendidikanterakhir" class="flex text-black text-md font-semibold mb-2">Pendidikan Terakhir</label>
                            <textarea type="text" name="pendidikanterakhir" class="p-2 border-2 border-gray-400 w-full rounded" rows="1" required>{{ $klien->pendidikanterakhir }}</textarea>
                        </div>
                        <div>
                            <label for="keperluan" class="flex text-black text-md font-semibold mb-2">Keperluan</label>
                            <textarea type="text" name="keperluan" class="p-2 border-2 border-gray-400 w-full rounded" rows="1" required>{{ $klien->keperluan }}</textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-5">
                        <button type="submit" class="rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Confirm</button>
                    </div>
                </form>
            </label>
            </label>
            <!-- MODAL LENGKAPI DATA DIRI -->
            <h1 class="text-2xl font-semibold mt-10 mb-10 text-center">Riwayat Tes</h1>
            <table class="w-full text-sm mb-5">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/12">No</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Judul Tes</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Tanggal Tes</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Status</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/12">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataTes as $index => $tes)
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $index + 1 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $tes->judul }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ \Carbon\Carbon::parse($tes->tanggaltes)->format('d-m-Y') }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $tes->status }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400">
                            <a href="{{ route('detailriwayattes', ['id' => $tes->id]) }}" class="text-blue-700 hover:text-blue-800 block">Detail</a>
                            @if($tes->status == 'Belum Dikerjakan')
                                <form id="deleteFormTes" action="{{ route('deleteformtes', ['id' => $tes->id]) }}" method="POST" class="flex justify-center mt-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cursor-pointer text-red-700 hover:text-red-800 block" onclick="deleteFormTesConfirmation(event)">Delete</button>
                                </form>
                            @endif
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function deleteKlien(event) {
                event.preventDefault();
                var confirmDelete = confirm("Apakah anda yakin ingin menghapus Klien beserta history test secara permanen?");
                if (confirmDelete) {
                    window.location.href = "{{ route('deleteklien', ['id' => $klien->id]) }}";
                }
            }
            function deleteFormTesConfirmation(event) {
                event.preventDefault();
                var confirmDelete = confirm("Apakah anda yakin ingin menghapus Form Tes?");
                if (confirmDelete) {
                    document.getElementById('deleteFormTes').submit();
                }
            }
        </script>
    </body>
</html>
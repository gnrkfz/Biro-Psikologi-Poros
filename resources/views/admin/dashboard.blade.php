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
                <a href="dashboard" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-black">Biro Psikologi Poros</span>
                </a>
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="dashboard" class="block py-2 px-4 text-blue-700 hover:text-blue-800 rounded" aria-current="page">Layanan</a>
                    </li>
                    <li>
                        <a href="daftarklien" class="block py-2 px-4 text-black rounded hover:text-blue-800">Klien</a>
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
        @if(session('updatepasswordsuccess'))
        <script>
            Swal.fire({
                text: "{{ session('updatepasswordsuccess') }}",
                icon: "success"
            });
        </script>
        @endif
        @if(session('createadminsuccess'))
        <script>
            Swal.fire({
                text: "{{ session('createadminsuccess') }}",
                icon: "success"
            });
        </script>
        @endif

        <!-- CONTENT -->
        <div class="bg-white my-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
            <div class="flex w-full mb-5">
                <div class="w-1/3">
                    <h1 class="text-3xl font-bold">Halo, {{ $user->nama }}</h1>
                    <h1 class="text-2xl font-semibold mb-5">Selamat Datang di Admin Panel</h1>
                </div>
                <div class="flex justify-end flex-grow">
                    <div class="flex flex-col text-center">
                        <a href="{{ route('adminsettings') }}" for="adminsettings" class="cursor-pointer text-sm rounded h-fit text-black hover:bg-gray-100 focus:ring-4 border border-black focus:ring-blue-300 py-1 px-2 mb-2">
                            Admin Settings
                        </a>
                        <a href="{{ route('tambahadmin') }}" for="adminsettings" class="cursor-pointer text-sm rounded h-fit text-black hover:bg-gray-100 focus:ring-4 border border-black focus:ring-blue-300 py-1 px-2">
                            Add New Admin
                        </a>
                    </div>
                </div>
            </div>
            <h1 class="text-2xl font-semibold mb-10 text-center">Daftar Layanan Test</h1>
            <div class="flex w-full mb-5">
                <div class="w-1/3 flex">
                    <input type="text" id="searchInput" oninput="searchTest()" placeholder="Cari..." class="border-2 border-gray-400 w-full rounded">
                </div>
                <div class="flex justify-end flex-grow items-center">
                    <div>
                    <label for="teskecerdasan" class="cursor-pointer rounded h-fit mr-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">
                        + Tes Kecerdasan
                    </label>
                    <!-- MODAL TAMBAH TES KECERDASAN -->
                    <input type="checkbox" id="teskecerdasan" class="peer fixed appearance-none opacity-0">
                        <label for="teskecerdasan" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
                            <label for="" class="max-h-[calc(100vh)-5em] h-fit w-full max-w-lg scale-90 overflow-y-auto overscroll-contain rounded bg-white px-10 pt-5 pb-10 text-black shadow-lg transition">
                                <div class="flex">
                                    <a href="/admin/dashboard" class="text-black ml-auto">
                                        <span class="text-xl">×</span>
                                    </a>
                                </div>
                                <h1 class="text-xl font-semibold mb-10 text-center">Tambah Tes Kecerdasan</h1>
                                <label for="judul" class="flex text-black text-md font-semibold mb-2">Judul Tes</label>
                                <form action="{{ route('tambahteskecerdasan') }}" method="post">
                                    @csrf
                                    <input type="text" name="judul" placeholder="Masukkan Judul Tes" class="p-2 border-2 border-gray-400 w-full rounded">
                                    <div class="flex justify-end flex-grow">
                                        <button type="submit" class="mt-6 rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Confirm</button>
                                    </div>
                                </form>
                            </label>
                        </label>
                    <!-- MODAL TAMBAH TES KECERDASAN -->
                    </div>
                    <div>
                    <label for="teskecermatan" class="cursor-pointer rounded h-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">
                        + Tes Kecermatan
                    </label>
                    <!-- MODAL TAMBAH TES KECERMATAN -->
                    <input type="checkbox" id="teskecermatan" class="peer fixed appearance-none opacity-0">
                        <label for="teskecermatan" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
                            <label for="" class="max-h-[calc(100vh)-5em] h-fit w-full max-w-lg scale-90 overflow-y-auto overscroll-contain rounded bg-white px-10 pt-5 pb-10 text-black shadow-lg transition">
                                <div class="flex">
                                    <a href="/admin/dashboard" class="text-black ml-auto">
                                        <span class="text-xl">×</span>
                                    </a>
                                </div>
                                <h1 class="text-xl font-semibold mb-10 text-center">Tambah Tes Kecermatan</h1>
                                <label for="judul" class="flex text-black text-md font-semibold mb-2">Judul Tes</label>
                                <form action="{{ route('tambahteskecermatan') }}" method="post">
                                    @csrf
                                    <input type="text" name="judul" placeholder="Masukkan Judul Tes" class="p-2 border-2 border-gray-400 w-full rounded">
                                    <div class="flex justify-end flex-grow">
                                        <button type="submit" class="mt-6 rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Confirm</button>
                                    </div>
                                </form>
                            </label>
                        </label>
                    <!-- MODAL TAMBAH TES KECERMATAN -->
                    </div>
                </div>
                
            </div>
            <table class="w-full text-sm mb-5">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400">No</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/2">Judul Tes</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/3">Jenis Tes</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tests as $index => $test)
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $index + 1 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $test->judul }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $test->jenis }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400">
                            <a href="{{ route('test.detail', ['id' => $test->id]) }}" class="text-blue-700">Detail</a>
                            <form id="deleteTest{{ $test->id }}" action="{{ route('deletetest', ['id' => $test->id]) }}" method="POST" class="flex justify-center mt-1">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="cursor-pointer text-red-700 hover:text-red-800 block" onclick="deleteTestConfirmation('{{ $test->id }}')">Delete</button>
                            </form>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- FUNGSI ALERT HAPUS TES -->
        <script>
            function deleteTestConfirmation(testId) {
                Swal.fire({
                    text: 'Apakah anda yakin ingin menghapus test termasuk soal di dalamnya secara permanen?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1d4ed8',
                    cancelButtonColor: '#b91c1c',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Test has been deleted.",
                            icon: "success",
                            showConfirmButton: false,
                        });
                        setTimeout(() => {
                            document.getElementById('deleteTest' + testId).submit();
                        }, 500);
                    }
                });
            };
        </script>
        <!-- FUNGSI SEARCH -->
        <script>
            function searchTest() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.querySelector("table");
                tr = table.getElementsByTagName("tr");
                for (i = 1; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("th")[1];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
    </body>
</html>
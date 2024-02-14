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
        <div class="bg-white mt-10 mx-10 px-20 py-10 shadow-lg rounded-lg text-center">
            <h1 class="text-2xl font-semibold mb-10">Daftar Klien</h1>
            <div class="flex justify-between mb-5">
                <div class="flex w-full">
                    <div class="flex mr-5">
                        <label for="entries">
                            <select id="entries" name="entries" class="rounded h-fit border-2 border-gray-400">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </label>
                    </div>
                    <div class="w-1/3 flex">
                        <input type="text" id="searchInput" oninput="searchKlien()" placeholder="Cari..." class="border-2 border-gray-400 w-full rounded">
                    </div>
                    <div class="flex justify-end flex-grow">
                        <label for="tw-modal" class="cursor-pointer rounded h-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">
                            + Add Klien
                        </label>
                    </div>
                    <!-- MODAL TAMBAH KLIEN -->
                    <input type="checkbox" id="tw-modal" class="peer fixed appearance-none opacity-0">
                    <label for="tw-modal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
                        <label for="" class="max-h-[calc(100vh)-5em] h-fit w-full max-w-lg scale-90 overflow-y-auto overscroll-contain rounded bg-white px-10 pt-5 pb-10 text-black shadow-lg transition">
                            <div class="flex">
                                <a href="/admin/daftarklien" class="text-black ml-auto">
                                    <span class="text-xl">×</span>
                                </a>
                            </div>
                            <h1 class="text-xl font-semibold mb-10 text-center">Tambah Klien</h1>
                            <label for="nama" class="flex text-black text-md font-semibold mb-2">Nama</label>
                            <form action="{{ route('tambahklien') }}" method="post">
                                @csrf
                                <input type="text" name="nama" placeholder="Masukkan Nama Klien" class="p-2 border-2 border-gray-400 w-full rounded">
                                <div class="flex justify-end flex-grow">
                                    <button type="submit" class="mt-6 rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Confirm</button>
                                </div>
                            </form>
                        </label>
                    </label>
                    <!-- MODAL TAMBAH KLIEN -->
                </div>
            </div>
            <table class="w-full text-sm mb-5">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400">No</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Nama</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Sex</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/4">Instansi</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/6">Kedatangan Terakhir</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/5">Tes/Keperluan</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/12">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kliens as $index => $klien)
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $index + 1 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $klien->nama }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $klien->jeniskelamin }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $klien->instansi }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $klien->kedatanganterakhir }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $klien->keperluan }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400">
                            <a href="{{ route('detailklien', ['id' => $klien->id]) }}" class="text-blue-700 hover:text-blue-800 block">Detail</a>
                            <a href="{{ route('formtes', ['id' => $klien->id]) }}" class="text-blue-700 hover:text-blue-800 block mt-1">Add Tes</a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- FUNGSI SEARCH -->
        <script>
            function searchKlien() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.querySelector("table");
                tr = table.getElementsByTagName("tr");
                for (i = 1; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("th")[0];
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
            document.getElementById("entries").addEventListener("change", function() {
                updateTableRows();
            });
            function updateTableRows() {
                var selectedValue = document.getElementById("entries").value;
                var tableRows = document.querySelectorAll("table tbody tr")
                tableRows.forEach(function(row) {
                    row.style.display = "none";
                });
                for (var i = 0; i < selectedValue; i++) {
                    if (tableRows[i]) {
                        tableRows[i].style.display = "";
                    }
                }
            }
            document.addEventListener("DOMContentLoaded", function() {
                updateTableRows();
            });
        </script>
    </body>
</html>
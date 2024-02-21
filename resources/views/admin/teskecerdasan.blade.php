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
                        <a href="/admin/dashboard" class="block py-2 px-4 text-blue-700 hover:text-blue-800 rounded" aria-current="page">Layanan</a>
                    </li>
                    <li>
                        <a href="/admin/daftarklien" class="block py-2 px-4 text-black rounded hover:text-blue-800">Klien</a>
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
        <div class="bg-white mt-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
        <a href="/admin/dashboard" class="text-black">
            <span class="text-xl">&larr;</span> Back
        </a>
            <h1 class="text-2xl font-semibold mb-10 text-center">Detail Tes Kecerdasan</h1>
            <h2 class="text-lg font-semibold mb-5">Judul Tes : {{ $test->judul }}</h2>
            <div class="flex mb-5">
                <div class="w-1/3 flex">
                    <input type="text" id="searchInput" oninput="searchSoal()" placeholder="Cari..." class="border-2 border-gray-400 w-full rounded">
                </div>
                <div class="flex justify-end flex-grow items-center">
                    <label for="tambahsoal" class="cursor-pointer rounded h-fit mr-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">
                        + Add Soal
                    </label>
                </div>
                <!-- MODAL TAMBAH SOAL -->
                <input type="checkbox" id="tambahsoal" class="peer fixed appearance-none opacity-0">
                    <label for="tambahsoal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
                        <label for="" class="max-h-[calc(100vh)-5em] h-fit w-full max-w-lg scale-90 overflow-y-auto overscroll-contain rounded bg-white py-5 px-10 text-black shadow-lg transition">
                            <form action="{{ route('tambahsoalteskecerdasan', ['id' => $id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <label for="idtest" class="flex text-black text-md font-semibold mb-2">ID Test</label>
                                <input type="text" name="idtest" placeholder="{{ $test->id }}" value="{{ $test->id }}" class="disabled p-2 border-2 border-gray-400 w-full rounded" readonly>
                                <label for="pertanyaan" class="flex text-black text-md font-semibold my-2">Pertanyaan</label>
                                <textarea type="text" name="pertanyaan" rows="2" placeholder="" class="p-2 border-2 border-gray-400 w-full rounded" required></textarea>
                                <label for="gambarsoal" class="flex text-black text-md font-semibold mt-1 mb-2">Upload Gambar</label>
                                <input type="file" name="gambarsoal" accept=".jpg, .jpeg, .png" class="border-2 border-gray-400 w-full rounded">
                                <div class="grid grid-cols-2 gap-x-5 gap-y-2 mt-2">
                                    <div>
                                        <label for="opsi1" class="flex text-black text-md font-semibold mb-2">Opsi 1</label>
                                        <input type="text" name="opsi1" placeholder="" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                    </div>
                                    <div>
                                        <label for="opsi2" class="flex text-black text-md font-semibold mb-2">Opsi 2</label>
                                        <input type="text" name="opsi2" placeholder="" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                    </div>
                                    <div>
                                        <label for="opsi3" class="flex text-black text-md font-semibold mb-2">Opsi 3</label>
                                        <input type="text" name="opsi3" placeholder="" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                    </div>
                                    <div>
                                        <label for="opsi4" class="flex text-black text-md font-semibold mb-2">Opsi 4</label>
                                        <input type="text" name="opsi4" placeholder="" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                    </div>
                                    <div>
                                        <label for="opsi5" class="flex text-black text-md font-semibold mb-2">Opsi 5</label>
                                        <input type="text" name="opsi5" placeholder="" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                    </div>
                                    <div>
                                        <label for="jawabanbenar" class="flex text-black text-md font-semibold mb-2">Jawaban Benar</label>
                                        <input type="text" name="jawabanbenar" placeholder="" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-x-5 gap-y-2 mt-2">
                                    <div>
                                        <label for="kategori" class="flex text-black text-md font-semibold mb-2">Kategori</label>
                                        <select name="kategori" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                            <option disabled selected>Pilih Kategori</option>
                                            <option value="Aritmatika">Aritmatika</option>
                                            <option value="Logis">Logis</option>
                                            <option value="Verbal">Verbal</option>
                                            <option value="Non Verbal">Non Verbal</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="level" class="flex text-black text-md font-semibold mb-2">Level</label>
                                        <select name="level" class="p-2 border-2 border-gray-400 w-full rounded" required>
                                            <option disabled selected>Pilih Level</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end flex-grow">
                                        <button type="submit" class="mt-8 rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Confirm</button>
                                    </div>
                                </div>
                            </form>
                        </label>
                    </label>
                <!-- MODAL TAMBAH SOAL -->
            </div>
            <table class="w-full text-sm mb-5">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400">No</th>
                        <th class="py-2 px-4 border-2 border-gray-400 w-1/5">Pertanyaan</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Opsi1</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Opsi2</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Opsi3</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Opsi4</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Opsi5</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Jawaban Benar</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Kategori</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Level</th>
                        <th class="py-2 px-4 border-2 border-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($soals as $index => $soal)
                    <tr>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $index + 1 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->pertanyaan }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->opsi1 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->opsi2 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->opsi3 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->opsi4 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->opsi5 }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->jawabanbenar }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal text-left">{{ $soal->kategori }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $soal->level }}</th>
                        <th class="py-2 px-4 border-2 border-gray-400 justify-center">
                            <a href="{{ route('detailsoalteskecerdasan', ['id' => $soal->id]) }}" class="cursor-pointer text-blue-700 hover:text-blue-800 block">Detail</a>
                            <form action="{{ route('deletesoalkecerdasan', ['id' => $soal->id]) }}" method="POST" class="flex justify-center mt-1">
                                @csrf
                                <button type="submit" class="cursor-pointer text-red-700 hover:text-red-800 block">Delete</button>
                            </form>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- FUNGSI SEARCH SOAL -->
        <script>
            function searchSoal() {
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
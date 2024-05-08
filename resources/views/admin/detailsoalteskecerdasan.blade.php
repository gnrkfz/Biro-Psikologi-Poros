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
        <h1 class="text-xl font-semibold text-center mb-5">Edit Soal</h1>
            <form action="{{ route('editsoalteskecerdasan', ['id' => $soal->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="idtest" class="flex text-black text-md font-semibold mb-2">ID Test</label>
                <input type="text" name="idtest" placeholder="{{ $test->id }}" value="{{ $test->id }}" class="disabled p-2 border-2 border-gray-400 w-full rounded" readonly>
                <label for="pertanyaan" class="flex text-black text-md font-semibold mb-2 mt-2.5">Pertanyaan</label>
                <textarea type="text" name="pertanyaan" rows="2" class="p-2 border-2 border-gray-400 w-full rounded" required>{{ $soal->pertanyaan }}</textarea>
                @if($soal->gambarsoal)
                    <label for="gambarsoal" class="flex text-black text-md font-semibold mb-2 mt-2.5">Gambar</label>
                    <img src="{{ asset('storage/' . $soal->gambarsoal) }}" alt="Current Image" class="mb-2.5">
                @endif
                <label for="gambarsoal" class="flex text-black text-md font-semibold mb-2 mt-2.5">Upload Gambar (JPG, JPEG, PNG)</label>
                <input type="file" name="gambarsoal" accept=".jpg, .jpeg, .png" class="border-2 border-gray-400 w-full rounded">
                <div class="grid grid-cols-2 gap-x-10 gap-y-2.5 mt-2.5">
                    <div>
                        <label for="opsi1" class="flex text-black text-md font-semibold mb-2">Opsi1</label>
                        <textarea type="text" name="opsi1" rows="1" class="p-2 border-2 border-gray-400 w-full rounded" required>{{ $soal->opsi1 }}</textarea>
                    </div>
                    <div>
                        <label for="opsi2" class="flex text-black text-md font-semibold mb-2">Opsi2</label>
                        <textarea type="text" name="opsi2" rows="1" class="p-2 border-2 border-gray-400 w-full rounded" required>{{ $soal->opsi2 }}</textarea>
                    </div>
                    <div>
                        <label for="opsi3" class="flex text-black text-md font-semibold mb-2">Opsi3</label>
                        <textarea type="text" name="opsi3" rows="1" class="p-2 border-2 border-gray-400 w-full rounded" required>{{ $soal->opsi3 }}</textarea>
                    </div>
                    <div>
                        <label for="opsi4" class="flex text-black text-md font-semibold mb-2">Opsi4</label>
                        <textarea type="text" name="opsi4" rows="1" class="p-2 border-2 border-gray-400 w-full rounded" required>{{ $soal->opsi4 }}</textarea>
                    </div>
                    <div>
                        <label for="opsi5" class="flex text-black text-md font-semibold mb-2">Opsi5</label>
                        <textarea type="text" name="opsi5" rows="1" class="p-2 border-2 border-gray-400 w-full rounded" required>{{ $soal->opsi5 }}</textarea>
                    </div>
                    <div>
                        <label for="jawabanbenar" class="flex text-black text-md font-semibold mb-2">Jawaban Benar</label>
                        <textarea type="text" name="jawabanbenar" rows="1" class="p-2 border-2 border-gray-400 w-full rounded" required>{{ $soal->jawabanbenar }}</textarea>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-x-5 gap-y-2.5 mt-2.5">
                    <div>
                        <label for="kategori" class="flex text-black text-md font-semibold mb-2">Kategori</label>
                        <select name="kategori" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            <option disabled>Pilih Kategori</option>
                            <option value="Aritmatika" {{ $soal->kategori == 'Aritmatika' ? 'selected' : '' }} >
                                Aritmatika
                            </option>
                            <option value="Logis" {{ $soal->kategori == 'Logis' ? 'selected' : '' }} >
                                Logis
                            </option>
                            <option value="Verbal" {{ $soal->kategori == 'Verbal' ? 'selected' : '' }} >
                                Verbal
                            </option>
                            <option value="Non Verbal" {{ $soal->kategori == 'Non Verbal' ? 'selected' : '' }} >
                                Non Verbal
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="level" class="flex text-black text-md font-semibold mb-2">Level</label>
                        <select name="level" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            <option disabled selected>Pilih Level</option>
                            <option value="1" {{ $soal->level == '1' ? 'selected' : '' }} >
                                1
                            </option>
                            <option value="2" {{ $soal->level == '2' ? 'selected' : '' }} >
                                2
                            </option>
                            <option value="3" {{ $soal->level == '3' ? 'selected' : '' }} >
                                3
                            </option>
                        </select>
                    </div>
                    <div class="flex justify-end flex-grow">
                        <button type="submit" class="mt-8 rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Simpan</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('deletesoalkecerdasan', ['id' => $soal->id]) }}" method="POST" class="flex justify-center mt-1">
                @csrf
                @method('DELETE')
                <div class="flex justify-end flex-grow">
                <button type="submit" class="mt-8 rounded text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 py-2 px-4">Delete Soal</button>
                </div>
            </form>
        </div>
    </body>
</html>
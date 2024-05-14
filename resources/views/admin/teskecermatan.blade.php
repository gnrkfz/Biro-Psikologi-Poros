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
        @if(session('karerror'))
        <script>
            Swal.fire({
                text: "{{ session('karerror') }}",
                icon: "error"
            });
        </script>
        @endif

        <!-- CONTENT -->
        <div class="bg-white mt-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
        <a href="/admin/dashboard" class="text-black">
            <span class="text-xl">&larr;</span> Back
        </a>
            <h1 class="text-2xl font-semibold mb-10 text-center">Detail Tes Kecermatan</h1>
            <h2 class="text-lg font-semibold mb-5 w-1/2">Judul Tes : {{ $test->judul }}</h2>
            <div class="flex mb-5">
                <div class="flex justify-end flex-grow items-center text-center">
                    <label for="tambahsoal" class="cursor-pointer rounded h-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-5">
                        + Soal
                    </label>
                </div>
                <!-- MODAL TAMBAH TES KECERMATAN -->
                <input type="checkbox" id="tambahsoal" class="peer fixed appearance-none opacity-0">
                    <label for="tambahsoal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
                        <label for="" class="max-h-[calc(100vh)-5em] h-fit w-full max-w-lg scale-90 overflow-y-auto overscroll-contain rounded bg-white py-5 px-10 text-black shadow-lg transition">
                            <h1 class="text-xl font-semibold mb-5">Tambah Soal</h1>
                            <form action="{{ route('tambahsoalteskecermatan', ['id' => $id]) }}" method="post" onsubmit="return validateForm()">
                                @csrf
                                <label for="idtest" class="flex text-black text-md font-semibold mb-2">ID Test</label>
                                <input type="text" name="idtest" placeholder="{{ $test->id }}" value="{{ $test->id }}" class="disabled p-2 border-2 border-gray-400 w-full rounded" readonly>
                                <div class="grid grid-cols-5 gap-2.5 mt-2.5">
                                    <div class="col-span-1">
                                        <label for="kar1" class="flex text-black text-md font-semibold mb-2">Kar 1</label>
                                        <input type="text" name="kar1" class="p-2 border-2 border-gray-400 w-full rounded" maxlength="1" required>
                                    </div>
                                    <div class="col-span-1">
                                        <label for="kar2" class="flex text-black text-md font-semibold mb-2">Kar 2</label>
                                        <input type="text" name="kar2" class="p-2 border-2 border-gray-400 w-full rounded" maxlength="1" required>
                                    </div>
                                    <div class="col-span-1">
                                        <label for="kar3" class="flex text-black text-md font-semibold mb-2">Kar 3</label>
                                        <input type="text" name="kar3" class="p-2 border-2 border-gray-400 w-full rounded" maxlength="1" required>
                                    </div>
                                    <div class="col-span-1">
                                        <label for="kar4" class="flex text-black text-md font-semibold mb-2">Kar 4</label>
                                        <input type="text" name="kar4" class="p-2 border-2 border-gray-400 w-full rounded" maxlength="1" required>
                                    </div>
                                    <div class="col-span-1">
                                        <label for="kar5" class="flex text-black text-md font-semibold mb-2">Kar 5</label>
                                        <input type="text" name="kar5" class="p-2 border-2 border-gray-400 w-full rounded" maxlength="1" required>
                                    </div>
                                </div>
                                <div class="flex justify-end flex-grow">
                                    <button type="submit" class="mt-5 rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Confirm</button>
                                </div>
                            </form>
                        </label>
                    </label>
                <!-- MODAL TAMBAH TES KECERMATAN -->
            </div>
            <table class="w-full text-sm mb-5">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-2 border-gray-400">No</th>
                    <th class="py-2 px-4 border-2 border-gray-400">Karakter 1</th>
                    <th class="py-2 px-4 border-2 border-gray-400">Karakter 2</th>
                    <th class="py-2 px-4 border-2 border-gray-400">Karakter 3</th>
                    <th class="py-2 px-4 border-2 border-gray-400">Karakter 4</th>
                    <th class="py-2 px-4 border-2 border-gray-400">Karakter 5</th>
                    <th class="py-2 px-4 border-2 border-gray-400">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soals as $index => $soal)
                <tr>
                    <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $index + 1 }}</th>
                    <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $soal->kar1 }}</th>
                    <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $soal->kar2 }}</th>
                    <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $soal->kar3 }}</th>
                    <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $soal->kar4 }}</th>
                    <th class="py-2 px-4 border-2 border-gray-400 font-normal">{{ $soal->kar5 }}</th>
                    <th class="py-2 px-4 border-2 border-gray-400 justify-center">
                        <form action="{{ route('deletesoalkecermatan', ['id' => $soal->id]) }}" method="POST" class="flex justify-center mt-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-red-700 hover:text-red-800 block">Delete</button>
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
            </table>
            <h5 class="mt-5 font-medium">Keterangan :</h5>
            <h5>
                <span class="{{ $jumlahSoal >= 10 ? 'text-green-500' : 'text-red-500' }}">
                    Jumlah Soal : {{ $jumlahSoal }}
                </span>
            </h5>
        </div>
    </body>
    <script>
        function showAlert(message) {
            alert(message);
        }
        function validateForm() {
            var kar1 = document.getElementsByName("kar1")[0].value;
            var kar2 = document.getElementsByName("kar2")[0].value;
            var kar3 = document.getElementsByName("kar3")[0].value;
            var kar4 = document.getElementsByName("kar4")[0].value;
            var kar5 = document.getElementsByName("kar5")[0].value;
            if (kar1.trim() === "" || kar2.trim() === "" || kar3.trim() === "" || kar4.trim() === "" || kar5.trim() === "") {
                showAlert("Gagal menambahkan tes kecermatan. Harap lengkapi semua kolom.");
                return false;
            }
            return true;
        }
    </script>
</html>
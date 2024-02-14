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
        <div class="bg-white mt-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
        <a href="#" onclick="history.back();" class="text-black">
            <span class="text-xl">&larr;</span> Back
        </a>
        <div class="text-center">
        <h1 class="text-2xl font-semibold mb-10 text-center">Tambah Tes Klien</h1>
        <form action="{{ route('tambahformtes') }}" method="POST">
            @csrf
            <div class="flex">
                <div class="w-1/6 pr-4">
                    <label for="idklien" class="flex text-black text-md font-semibold mb-2">ID Klien</label>
                    <input type="text" name="idklien" value="{{ $klien->id }}" class="p-2 border-2 border-gray-400 w-full rounded" readonly>
                </div>
                <div class="w-1/2 px-4">
                    <label for="nama" class="flex text-black text-md font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ $klien->nama }}" class="p-2 border-2 border-gray-400 w-full rounded" readonly>
                </div>
                <div class="w-1/3 pl-4">
                    <label for="tanggaltes" class="flex text-black text-md font-semibold mb-2">Tanggal Tes</label>
                    <input type="text" name="tanggaltes" value="{{ now()->format('d-m-Y') }}" class="p-2 border-2 border-gray-400 w-full rounded" readonly>
                </div>
            </div>
            <div id="additionalTestsContainer" class="block mt-5"></div>
            <input type="hidden" name="testcounter" id="testCounterInput" value="0">
            <button type="button" id="tambahtes" class="font-semibold text-blue-700 hover:text-blue-800 cursor-pointer mt-5">-------------------- + Tambah Tes --------------------</button>
            <div class="flex justify-center">
                <button type="submit" id="submit" class="py-2.5 px-5 rounded font-semibold text-white bg-blue-700 hover:bg-blue-800 cursor-pointer mt-5 hidden">Confirm</button>
            </div>
        </form>
        </div>
        </div>
        <!-- SCRIPT MENAMBAH TES -->
        <script>
        let testCounter = 0;
        document.getElementById('tambahtes').addEventListener('click', function () {
            var additionalTestsContainer = document.getElementById('additionalTestsContainer');
            var existingTestFields = additionalTestsContainer.querySelectorAll('.test-field').length;
            var rowNumber = Math.floor(existingTestFields / 3) + 1;
            testCounter++;
            document.getElementById('testCounterInput').value = testCounter;
            var newTestField = document.createElement('div');
            newTestField.className = 'w-1/3 border shadow-md p-2.5 mx-2.5 mt-5 test-field';
            newTestField.innerHTML = `
                <button type="button" class="flex font-semibold text-red-600 hover:text-red-800" onclick="removeTestField(this)">X</button>
                <label for="idklien" class="justify-center flex text-black text-md font-semibold mb-2">Tes ${testCounter}</label>
                <select name="test${testCounter}" class="p-2 border-2 border-gray-400 w-full rounded">
                    <option disabled selected>Pilih Tes</option>
                    @foreach ($tests as $test)
                    <option value="{{ $test->id }}">{{ $test->judul }}</option>
                    @endforeach
                </select>
            `;
            if (existingTestFields % 3 === 0) {
                var newRow = document.createElement('div');
                newRow.className = 'flex justify-center';
                additionalTestsContainer.appendChild(newRow);
            }
            additionalTestsContainer.lastChild.appendChild(newTestField);
            document.getElementById('submit').classList.remove('hidden');
        });
        function removeTestField(button) {
            var testFieldContainer = button.parentElement;
            testCounter--;
            document.getElementById('testCounterInput').value = testCounter;
            testFieldContainer.parentNode.removeChild(testFieldContainer);
            if (testCounter === 0) {
                document.getElementById('submit').classList.add('hidden');
            }
        }
        </script>
    </body>
</html>
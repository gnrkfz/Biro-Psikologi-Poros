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
            <a href="dashboard" class="text-black">
                <span class="text-xl">&larr;</span> Back
            </a>
            <h1 class="text-2xl font-semibold mb-10 text-center">Tambah Admin</h1>
            @if(session('success'))
            <div class="bg-green-200 text-green-700 -mt-5 p-4 mb-4 rounded text-center">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('createadmin') }}" method="post" class="text-black">
                @csrf
                <div class="mb-2.5">
                    <label for="nama" class="block text-sm font-medium text-gray-600">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-2.5">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 p-2 w-full border rounded-md">
                </div>
                @error('email')
                <p class="text-red-700 font-medium text-sm mb-2">{{ $message }}</p>
                @enderror
                <div class="mb-2.5">
                    <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 p-2 w-full border rounded-md">
                </div>
                <div class="mb-2.5">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 p-2 w-full border rounded-md">
                </div>
                @error('password')
                <p class="text-red-700 font-medium text-sm">{{ $message }}</p>
                @enderror
                <div class="flex items-center justify-between mt-6">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 transition ease-in-out duration-100 text-white px-4 py-2 rounded-md">Confirm</button>
                </div>
            </form>
        </div>
    </body>
</html>
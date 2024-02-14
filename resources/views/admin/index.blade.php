<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto flex items-center justify-center h-screen">
            <div class="bg-white py-12 px-16 shadow-lg rounded-lg text-center">
                <img src="/img/logoporos.png" alt="logoporos" class="mx-auto mb-8 max-w-full h-auto">
                <h1 class="text-3xl font-bold mb-8">Masuk Admin</h1>
                <form method="POST" action="{{ route('admin.loginadmin') }}" class="mx-auto">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="flex text-gray-700 text-md font-semibold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="flex w-full px-3 py-2 border border-gray-500 rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="flex text-gray-700 text-md font-semibold mb-2">Password</label>
                        <input type="password" id="password" name="password" class=" flex w-full px-3 py-2 border border-gray-500 rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger text-md font-medium text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-4 w-auto ml-52 bg-blue-700 hover:bg-blue-800 text-white font-semibold text-md rounded-lg py-2 px-8 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>

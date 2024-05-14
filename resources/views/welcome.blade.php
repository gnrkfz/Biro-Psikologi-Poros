<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Biro Psikologi Poros</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto flex items-center justify-center h-screen">
            <div class="bg-white p-12 shadow-lg rounded-lg text-center">
                <img src="/img/logoporos.png" alt="logoporos" class="mx-auto mb-8 max-w-full h-auto">
                <h1 class="text-3xl font-bold mb-8">Selamat Datang di Biro Psikologi Poros</h1>
                <div class="flex space-x-10">
                    <a href="/klien" class="flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-semibold rounded-lg text-md px-auto py-6 focus:outline-none">
                        Klien
                    </a>
                    <a href="/admin" class="flex-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-semibold rounded-lg text-md px-auto py-6 focus:outline-none">
                        Admin
                    </a>
                </div>
            </div>
        </div>
        <script>
            localStorage.clear();
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        </script>
    </body>
</html>
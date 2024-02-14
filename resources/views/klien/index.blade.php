<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Klien</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto flex items-center justify-center h-screen">
            <div class="bg-white p-12 shadow-lg rounded-lg text-center">
                <img src="/img/logoporos.png" alt="logoporos" class="mx-auto mb-8 max-w-full h-auto">
                <h1 class="text-3xl font-bold mb-8">Masuk Klien</h1>
                <form method="POST" action="{{ route('klien.loginklien') }}" class="mx-auto">
                    @csrf
                    <label for="id" class="flex text-black text-md font-semibold mb-2">Nama</label>
                    <select id="id" name="id" class="mb-8 bg-white border border-gray-500 text-black text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full px-3">
                        <option disabled selected>Pilih Nama</option>
                        @foreach($klienList as $klien)
                        <option value="{{ $klien->id }}">{{ $klien->nama }}</option>
                        @endforeach
                    </select>
                    <button type="submit" name="submit" class="btn btn-primary w-auto ml-56 bg-blue-700 hover:bg-blue-800 text-white font-semibold text-md rounded-lg py-2 px-8 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>

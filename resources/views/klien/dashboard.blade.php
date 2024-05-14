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
    <img src="/img/logoporos.png" alt="logoporos" class="mt-5 mx-auto max-w-full h-auto">
        <div class="bg-white mt-5 mx-10 px-20 py-10 shadow-lg rounded-lg">
            <h1 class="text-3xl font-bold mb-5 text-center">Selamat Datang, {{ $klien->nama }}!</h1>
            @if(isset($completeProfilePrompt))
                <label for="tw-modal" class="block mx-96 items-center text-center cursor-pointer rounded h-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-3">
                    Klik untuk Melengkapi Data Diri
                </label>
                <!-- MODAL LENGKAPI DATA DIRI -->
                <input type="checkbox" id="tw-modal" class="peer fixed appearance-none opacity-0">
                <label for="tw-modal" class="pointer-events-none invisible fixed inset-0 flex cursor-pointer items-center justify-center overflow-hidden overscroll-contain bg-black/50 opacity-0 transition-all duration-200 ease-in-out peer-checked:pointer-events-auto peer-checked:visible peer-checked:opacity-100 peer-checked:[&>*]:translate-y-0 peer-checked:[&>*]:scale-100 ">
                <label for="" class="max-h-[calc(100vh)-5em] h-fit w-full max-w-xl scale-90 overflow-y-auto overscroll-contain rounded bg-white py-5 px-10 text-black shadow-lg transition">
                    <h1 class="text-xl font-semibold mb-5 text-center">Lengkapi Data Diri</h1>
                    <form action="{{ route('isidatadiri') }}" method="post">
                        @csrf
                        <div class="grid grid-cols-2 gap-5">
                            <div>
                                <label for="nama" class="flex text-black text-md font-semibold mb-2">Nama</label>
                                <input type="text" name="nama" placeholder="{{ $klien->nama }}" class="disabled p-2 border-2 border-gray-400 w-full rounded" value="{{ $klien->nama }}" readonly>
                            </div>
                            <div> 
                                <label for="jeniskelamin" class="flex text-black text-md font-semibold mb-2">Jenis Kelamin</label>
                                <div>
                                    <label>
                                        <input type="radio" name="jeniskelamin" value="L" required>
                                        Laki-laki
                                    </label>
                                </div>
                                <div>
                                    <label>
                                        <input type="radio" name="jeniskelamin" value="P" required>
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="tanggallahir" class="flex text-black text-md font-semibold mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggallahir" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                            <div>
                                <label for="email" class="flex text-black text-md font-semibold mb-2">Email</label>
                                <input type="text" name="email" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                            <div>
                                <label for="nomortelepon" class="flex text-black text-md font-semibold mb-2">No. Telepon</label>
                                <input type="text" name="nomortelepon" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                            <div>
                                <label for="alamat" class="flex text-black text-md font-semibold mb-2">Alamat</label>
                                <input type="text" name="alamat" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                            <div>
                                <label for="kota" class="flex text-black text-md font-semibold mb-2">Kota</label>
                                <input type="text" name="kota" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                            <div>
                                <label for="instansi" class="flex text-black text-md font-semibold mb-2">Instansi</label>
                                <input type="text" name="instansi" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                            <div>
                                <label for="pendidikanterakhir" class="flex text-black text-md font-semibold mb-2">Pendidikan Terakhir</label>
                                <input type="text" name="pendidikanterakhir" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                            <div>
                                <label for="keperluan" class="flex text-black text-md font-semibold mb-2">Keperluan</label>
                                <input type="text" name="keperluan" class="p-2 border-2 border-gray-400 w-full rounded" required>
                            </div>
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="submit" class="rounded text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 py-2 px-4">Confirm</button>
                        </div>
                    </form>
                </label>
                </label>
                <!-- MODAL LENGKAPI DATA DIRI -->
            @endif
            @unless(isset($completeProfilePrompt))
            <div>
                <h1 class="text-xl font-semibold mb-10 text-center">Anda telah mengisi Data Diri.</h1>
                @if(isset($formtes) && count($formtes) > 0)
                <h2 class="text-lg font-normal my-5 text-center">Berikut adalah tes yang harus Anda kerjakan :</h2>
                @else
                <h2 class="text-xl font-semibold mb-10 text-center">--- Form Tes Kosong ---</h2>
                @endif
                @foreach($formtes as $index => $formtes)
                <div class="border-t border-black px-20 py-5">
                    <div class="flex grid-cols-4 gap-5 items-center">
                        <div class="w-1/3">
                            <h1 class="text-md">
                                <span class="font-normal">{{ $index + 1 }}.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <span class="font-semibold">{{ $formtes->judultest }}</span>
                            </h1>
                        </div>
                        <div class="w-1/4">
                            <h1>Jumlah Soal : {{ $formtes->jenistest == 'Tes Kecerdasan' ? '100 Soal' : '50 Soal x 10 Sesi' }}</h1>
                        </div>
                        <div class="w-1/4">
                            <h1>Waktu : {{ $formtes->jenistest == 'Tes Kecerdasan' ? '80 Menit' : '1 Menit / Sesi' }}</h1>
                        </div>
                        <div class="w-1/6">
                            @if($index + 1 == 1)
                            <a onclick="startTest(event)" href="{{ $formtes->jenistest == 'Tes Kecerdasan' ? route('pengerjaanteskecerdasan', ['id' => $formtes->id]) : route('pengerjaanteskecermatan', ['id' => $formtes->id, 'sesi' => 1]) }}" class="text-sm bg-blue-700 hover:bg-blue-800 text-white px-3 py-2 rounded-lg">KERJAKAN SEKARANG</a>
                            @else
                            <a disabled class="text-sm bg-gray-500 text-white px-3 py-2 rounded-lg">KERJAKAN SEKARANG</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="border-t border-black"></div>
            </div>
            @endunless
            <div class="mt-5">
                <a href="/" class="text-red-700 hover:text-red-800 mt-10">
                    <span class="text-xl">&larr;</span> Keluar
                </a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
            function startTest(event) {
                event.preventDefault();
                Swal.fire({
                    text: 'Apakah anda yakin ingin memulai tes?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1d4ed8',
                    cancelButtonColor: '#b91c1c',
                    confirmButtonText: 'Ya, Mulai'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = event.target.getAttribute('href');
                    }
                });
            };
        </script>
    </body>
</html>

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
        <div class="bg-white my-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
            <a href="#" onclick="history.back();" class="text-black">
                <span class="text-xl">&larr;</span> Back
            </a>
            <h1 class="text-2xl font-semibold mb-10 text-center">Jawaban Tes Kecerdasan Klien</h1>
            <div class="flex grid-cols-2 mb-5">
                <div class="w-1/12">
                    <h2 class="flex font-medium text-md mb-2.5">ID Form Tes</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Nama Tes</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Nama Klien</h2>
                    <h2 class="flex font-medium text-md mb-2.5">Tanggal Tes</h2>
                </div>
                <div class="w-11/12">
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $formtes->id }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $formtes->judultest }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ $klien->nama }}</h2>
                    <h2 class="flex font-medium text-md mb-2.5">: {{ date('d-m-Y', strtotime($formtes->tanggaltes)) }}</h2>
                </div>
            </div>
            <!-- DAFTAR NOMOR -->
            <div class="w-full p-5 mb-10 border-b border-black">
                <div class="flex flex-wrap justify-center mb-5">
                    @foreach($soal as $index => $item)
                        @php
                            $bgClass = '';
                            if ($jawabanteskecerdasan[$index]->jawabanklien == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            } else {
                                $bgClass = 'bg-red-200';
                            }
                        @endphp
                    <div id="nomor-{{ $index + 1 }}" class="w-10 h-10 cursor-pointer mx-1 my-1 rounded flex items-center justify-center {{ $bgClass }}" onclick="scrollToSoal({{ $index + 1 }})">
                        <a>{{ $index + 1 }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- DAFTAR SOAL DAN JAWABAN -->
            <div class="w-full">
                @foreach($soal as $index => $item)
                <div id="soal-{{ $index + 1 }}" class="mb-6">
                    <span class="font-normal text-lg">{{ $index + 1 }}.&nbsp;</span>
                    <span class="font-semibold text-lg">{{ $item->pertanyaan }}</span>
                    <span class="flex font-normal">Kategori : {{ $item->kategori }}&nbsp;</span>
                    <span class="flex font-normal">Level : {{ $item->level }}&nbsp;</span>
                    @if(isset($item->gambarsoal))
                    <img src="{{ asset('storage/' . $item->gambarsoal) }}" alt="Gambar Soal" class="ml-5 max-w-full mx-2">
                    @endif
                    <ul class="list-none p-0">
                        @php
                            $bgClass = '';
                            if ($item->opsi1 == $jawabanteskecerdasan[$index]->jawabanklien && $item->opsi1 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            } elseif ($item->opsi1 == $jawabanteskecerdasan[$index]->jawabanklien) {
                                $bgClass = 'bg-gray-200';
                            } elseif ($item->opsi1 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            }
                        @endphp
                        <li class="px-5 py-2.5 rounded {{ $bgClass }}">
                            <label for="opsi1-{{ $index + 1 }}" class="pointer-events-none">
                                <input type="radio" id="opsi1-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi1 }}" @if($item->opsi1 == $jawabanteskecerdasan[$index]->jawabanklien) checked @endif>
                                {{ $item->opsi1 }}
                            </label>
                        </li>
                        @php
                            $bgClass = '';
                            if ($item->opsi2 == $jawabanteskecerdasan[$index]->jawabanklien && $item->opsi2 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            } elseif ($item->opsi2 == $jawabanteskecerdasan[$index]->jawabanklien) {
                                $bgClass = 'bg-gray-200';
                            } elseif ($item->opsi2 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            }
                        @endphp
                        <li class="px-5 py-2.5 rounded {{ $bgClass }}">
                            <label for="opsi2-{{ $index + 1 }}" class="pointer-events-none">
                                <input type="radio" id="opsi2-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi2 }}" @if($item->opsi2 == $jawabanteskecerdasan[$index]->jawabanklien) checked @endif>
                                {{ $item->opsi2 }}
                            </label>
                        </li>
                        @php
                            $bgClass = '';
                            if ($item->opsi3 == $jawabanteskecerdasan[$index]->jawabanklien && $item->opsi3 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            } elseif ($item->opsi3 == $jawabanteskecerdasan[$index]->jawabanklien) {
                                $bgClass = 'bg-gray-200';
                            } elseif ($item->opsi3 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            }
                        @endphp
                        <li class="px-5 py-2.5 rounded {{ $bgClass }}">
                            <label for="opsi3-{{ $index + 1 }}" class="pointer-events-none">
                                <input type="radio" id="opsi3-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi3 }}" @if($item->opsi3 == $jawabanteskecerdasan[$index]->jawabanklien) checked @endif>
                                {{ $item->opsi3 }}
                            </label>
                        </li>
                        @php
                            $bgClass = '';
                            if ($item->opsi4 == $jawabanteskecerdasan[$index]->jawabanklien && $item->opsi4 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            } elseif ($item->opsi4 == $jawabanteskecerdasan[$index]->jawabanklien) {
                                $bgClass = 'bg-gray-200';
                            } elseif ($item->opsi4 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            }
                        @endphp
                        <li class="px-5 py-2.5 rounded {{ $bgClass }}">
                            <label for="opsi4-{{ $index + 1 }}" class="pointer-events-none">
                                <input type="radio" id="opsi4-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi4 }}" @if($item->opsi4 == $jawabanteskecerdasan[$index]->jawabanklien) checked @endif>
                                {{ $item->opsi4 }}
                            </label>
                        </li>
                        @php
                            $bgClass = '';
                            if ($item->opsi5 == $jawabanteskecerdasan[$index]->jawabanklien && $item->opsi5 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            } elseif ($item->opsi5 == $jawabanteskecerdasan[$index]->jawabanklien) {
                                $bgClass = 'bg-gray-200';
                            } elseif ($item->opsi5 == $item->jawabanbenar) {
                                $bgClass = 'bg-green-200';
                            }
                        @endphp
                        <li class="px-5 py-2.5 rounded {{ $bgClass }}">
                            <label for="opsi5-{{ $index + 1 }}" class="pointer-events-none">
                                <input type="radio" id="opsi5-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi5 }}" @if($item->opsi5 == $jawabanteskecerdasan[$index]->jawabanklien) checked @endif>
                                {{ $item->opsi5 }}
                            </label>
                        </li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
        <script>
            function scrollToSoal(index) {
                var element = document.getElementById('soal-' + index);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        </script>
    </body>
</html>
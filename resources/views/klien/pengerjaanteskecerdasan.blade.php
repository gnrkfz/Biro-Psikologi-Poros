<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $formtes->judultest }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100">
    <div id="timer" class="py-2.5 px-3 text-black border-black border rounded fixed right-5"></div>
    <img src="/img/logoporos.png" alt="logoporos" class="mt-5 mx-auto max-w-full h-auto">
        <div class="bg-white mt-5 mb-10 mx-10 px-20 py-10 shadow-lg rounded-lg">
            <!-- Bagian Daftar Nomor -->
            <div class="w-full p-5 mb-10 border-b border-black">
                <div class="flex flex-wrap justify-center mb-5">
                    @foreach($soal as $index => $item)
                    <div id="nomor-{{ $index + 1 }}" class="w-10 h-10 cursor-pointer mx-1 my-1 rounded flex items-center justify-center bg-gray-200" onclick="scrollToSoal({{ $index + 1 }})">
                        <a>{{ $index + 1 }}</a>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Bagian Soal -->
            <form id="testForm" action="{{ route('submitjawabanteskecerdasan') }}" method="POST" onsubmit="clearLocalStorage()">
            @csrf
                <input type="hidden" name="idformtes" value="{{ $formtes->id }}">
                <input type="hidden" name="idklien" value="{{ $formtes->idklien }}">
                <div class="w-full">
                    @foreach($soal as $index => $item)
                    <div id="soal-{{ $index + 1 }}" class="mb-6">
                        <input type="hidden" name="idsoal-{{ $index + 1 }}" value="{{ $item->id }}">
                        <input type="hidden" name="jawaban-{{ $index + 1 }}" value="null">
                        <span class="font-normal text-lg">{{ $index + 1 }}.&nbsp;</span>
                        <span class="font-semibold text-lg">{{ $item->pertanyaan }}</span>
                        @if(isset($item->gambarsoal))
                        <img src="{{ asset('storage/' . $item->gambarsoal) }}" alt="Gambar Soal" class="ml-5 max-w-full mx-2">
                        @endif
                        <ul class="list-none p-0">
                            <li class="cursor-pointer hover:bg-gray-200 px-5 py-2.5 rounded" onclick="selectOption('opsi1-{{ $index + 1 }}', 'nomor-{{ $index + 1 }}')">
                                <label for="opsi1-{{ $index + 1 }}" class="pointer-events-none">
                                    <input type="radio" id="opsi1-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi1 }}">
                                    {{ $item->opsi1 }}
                                </label>
                            </li>
                            <li class="cursor-pointer hover:bg-gray-200 px-5 py-2.5 rounded" onclick="selectOption('opsi2-{{ $index + 1 }}', 'nomor-{{ $index + 1 }}')">
                                <label for="opsi2-{{ $index + 1 }}" class="pointer-events-none">
                                    <input type="radio" id="opsi2-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi2 }}">
                                    {{ $item->opsi2 }}
                                </label>
                            </li>
                            <li class="cursor-pointer hover:bg-gray-200 px-5 py-2.5 rounded" onclick="selectOption('opsi3-{{ $index + 1 }}', 'nomor-{{ $index + 1 }}')">
                                <label for="opsi3-{{ $index + 1 }}" class="pointer-events-none">
                                    <input type="radio" id="opsi3-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi3 }}">
                                    {{ $item->opsi3 }}
                                </label>
                            </li>
                            <li class="cursor-pointer hover:bg-gray-200 px-5 py-2.5 rounded" onclick="selectOption('opsi4-{{ $index + 1 }}', 'nomor-{{ $index + 1 }}')">
                                <label for="opsi4-{{ $index + 1 }}" class="pointer-events-none">
                                    <input type="radio" id="opsi4-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi4 }}">
                                    {{ $item->opsi4 }}
                                </label>
                            </li>
                            <li class="cursor-pointer hover:bg-gray-200 px-5 py-2.5 rounded" onclick="selectOption('opsi5-{{ $index + 1 }}', 'nomor-{{ $index + 1 }}')">
                                <label for="opsi5-{{ $index + 1 }}" class="pointer-events-none">
                                    <input type="radio" id="opsi5-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $item->opsi5 }}">
                                    {{ $item->opsi5 }}
                                </label>
                            </li>
                        </ul>
                        <div>
                            <a onclick="clearOption({{ $index + 1 }})" class="cursor-pointer text-center text-blue-700 hover:text-blue-800">Clear Option</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Tombol Submit -->
                <div class="flex justify-end flex-grow">
                    <button id="submitButton" class="w-1/5 text-center bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-4 py-2 rounded mx-5">Selesai</button>
                </div>
            </form>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                for (let index = 1; index <= {{ count($soal) }}; index++) {
                    const savedAnswer = localStorage.getItem('jawaban-' + index);
                    if (savedAnswer) {
                        const radio = document.getElementById(savedAnswer);
                        const nomor = document.getElementById('nomor-' + index);
                        if (radio && nomor) {
                            radio.checked = true;
                            nomor.classList.remove('bg-gray-200');
                            nomor.classList.add('bg-blue-400');
                        }
                    }
                }
                const startTime = localStorage.getItem('timerStartTime');
                let timeRemaining = 80 * 60;
                if (startTime) {
                    const elapsedTime = Math.floor((Date.now() - parseInt(startTime)) / 1000);
                    timeRemaining = Math.max(timeRemaining - elapsedTime, 0);
                } else {
                    localStorage.setItem('timerStartTime', Date.now());
                }
                const timerElement = document.getElementById('timer');
                function updateTimerDisplay() {
                    const minutes = Math.floor(timeRemaining / 60);
                    const seconds = timeRemaining % 60;
                    timerElement.textContent = `${minutes} : ${seconds < 10 ? '0' : ''}${seconds}`;
                }
                function submitForm() {
                    document.getElementById('testForm').submit();
                    localStorage.clear();
                }
                function countdown() {
                    updateTimerDisplay();
                    if (timeRemaining <= 0) {
                        submitForm();
                    } else {
                        timeRemaining -= 1;
                        setTimeout(countdown, 1000);
                    }
                }
                countdown();
            });
            function selectOption(radioId, nomorId) {
                var radio = document.getElementById(radioId);
                var nomor = document.getElementById(nomorId);
                if (radio && nomor) {
                    radio.checked = !radio.checked;
                    if (radio.checked) {
                        localStorage.setItem('jawaban-' + nomorId.split('-')[1], radioId);
                    } else {
                        localStorage.removeItem('jawaban-' + nomorId.split('-')[1]);
                    }
                    nomor.classList.toggle('bg-gray-200');
                    nomor.classList.toggle('bg-blue-400', radio.checked);
                }
            }
            function clearOption(index) {
                var radioButtons = document.getElementsByName('jawaban-' + index);
                radioButtons.forEach(function(radio) {
                    radio.checked = false;
                });
                var nomor = document.getElementById('nomor-' + index);
                if (nomor) {
                    nomor.classList.remove('bg-blue-400');
                    nomor.classList.add('bg-gray-200');
                }
                localStorage.removeItem('jawaban-' + index);
            }
            function scrollToSoal(index) {
                var element = document.getElementById('soal-' + index);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
            function clearLocalStorage() {
                localStorage.clear();
            }
            function submitConfirmation(event) {
                event.preventDefault();
                var confirmSubmit = confirm("Apakah anda yakin ingin menyelesaikan tes?");
                if (confirmSubmit) {
                    document.getElementById('testForm').submit();
                    localStorage.clear();
                }
            }
            document.getElementById("submitButton").addEventListener("click", submitConfirmation);
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        </script>
    </body>
</html>
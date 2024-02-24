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
    <div id="timer" class="py-2.5 px-3 text-black font-semibold border-black border-2 z-50 rounded fixed right-5 top-5"></div>
        <div class="mx-auto flex flex-col items-center justify-center w-full bg-white fixed left-1/2 transform -translate-x-1/2 h-auto py-5 top-0 rounded-b-lg shadow-md" id="soal-utama">
            <img src="/img/logoporos.png" alt="logoporos" class="mx-auto max-w-full h-auto">
            <h1 class="text-2xl font-bold text-center">Sesi : {{ $jawabanteskecermatan->sesi }} / 10</h1>
            <table class="text-sm w-1/3 justify-center h-full">
                <thead>
                    <tr>
                        <th class="text-lg font-medium py-2 px-4 border-2 border-gray-400">A</th>
                        <th class="text-lg font-medium py-2 px-4 border-2 border-gray-400">B</th>
                        <th class="text-lg font-medium py-2 px-4 border-2 border-gray-400">C</th>
                        <th class="text-lg font-medium py-2 px-4 border-2 border-gray-400">D</th>
                        <th class="text-lg font-medium py-2 px-4 border-2 border-gray-400">E</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-3xl py-2 px-4 border-2 border-gray-400">{{ $soal->kar1 }}</th>
                        <th class="text-3xl py-2 px-4 border-2 border-gray-400">{{ $soal->kar2 }}</th>
                        <th class="text-3xl py-2 px-4 border-2 border-gray-400">{{ $soal->kar3 }}</th>
                        <th class="text-3xl py-2 px-4 border-2 border-gray-400">{{ $soal->kar4 }}</th>
                        <th class="text-3xl py-2 px-4 border-2 border-gray-400">{{ $soal->kar5 }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bg-white mt-60 mb-10 mx-10 px-20 py-10 shadow-lg rounded-lg border">
            <!-- Bagian 50 Soal Acak -->
            <form id="jawabanForm" action="{{ route('submitjawabanteskecermatan') }}" method="POST" onsubmit="submitForm(event)">
                @csrf
                <input type="hidden" id="idformtesInput" name="idformtes" value="{{ $formtes->id }}">
                <input type="hidden" id="idsoalInput" name="idsoal" value="{{ $soal->id }}">
                <input type="hidden" id="correctAnswersInput" name="correctAnswers" value="0">
                <input type="hidden" id="wrongAnswersInput" name="wrongAnswers" value="0">
                <input type="hidden" id="sesi" name="sesi" value="{{ $sesi }}">
                @foreach ($subsoal as $index => $subSoalItem)
                <div class="mx-auto w-2/3 h-full flex items-start justify-between mb-5" id="sub-soal">
                    <h2 id="nomor-{{ $index + 1 }}" class="text-lg mt-5 font-bold mr-2.5">
                        {{ $index + 1 < 10 ? '0' : '' }}{{ $index + 1 }}.
                    </h2>
                    <div class="w-1/2">
                        <table class="text-sm w-full justify-center h-full">
                            <tbody>
                                <tr id="soal-acak">
                                    <th class="text-3xl py-3 border-2 border-gray-400 w-1/4">{{ $subSoalItem['kar1'] }}</th>
                                    <th class="text-3xl py-3 border-2 border-gray-400 w-1/4">{{ $subSoalItem['kar2'] }}</th>
                                    <th class="text-3xl py-3 border-2 border-gray-400 w-1/4">{{ $subSoalItem['kar3'] }}</th>
                                    <th class="text-3xl py-3 border-2 border-gray-400 w-1/4">{{ $subSoalItem['kar4'] }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-1/2 ml-5">
                        <table class="text-sm w-full justify-center h-full">
                            <tbody>
                                <tr>
                                    <td class="cursor-pointer px-2.5 py-4 border-2 border-gray-400 text-center hover:bg-gray-200" onclick="selectRadio('kar1-{{ $index + 1 }}', '{{ $subSoalItem['karhilang'] }}')">
                                        <input type="radio" id="kar1-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $soal->kar1 }}">
                                        <label for="kar1-{{ $index + 1 }}" class="text-lg font-bold pointer-events-none">A</label>
                                    </td>
                                    <td class="cursor-pointer px-2.5 py-4 border-2 border-gray-400 text-center hover:bg-gray-200" onclick="selectRadio('kar2-{{ $index + 1 }}', '{{ $subSoalItem['karhilang'] }}')">
                                        <input type="radio" id="kar2-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $soal->kar2 }}">
                                        <label for="kar2-{{ $index + 1 }}" class="text-lg font-bold pointer-events-none">B</label>
                                    </td>
                                    <td class="cursor-pointer px-2.5 py-4 border-2 border-gray-400 text-center hover:bg-gray-200" onclick="selectRadio('kar3-{{ $index + 1 }}', '{{ $subSoalItem['karhilang'] }}')">
                                        <input type="radio" id="kar3-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $soal->kar3 }}">
                                        <label for="kar3-{{ $index + 1 }}" class="text-lg font-bold pointer-events-none">C</label>
                                    </td>
                                    <td class="cursor-pointer px-2.5 py-4 border-2 border-gray-400 text-center hover:bg-gray-200" onclick="selectRadio('kar4-{{ $index + 1 }}', '{{ $subSoalItem['karhilang'] }}')">
                                        <input type="radio" id="kar4-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $soal->kar4 }}">
                                        <label for="kar4-{{ $index + 1 }}" class="text-lg font-bold pointer-events-none">D</label>
                                    </td>
                                    <td class="cursor-pointer px-2.5 py-4 border-2 border-gray-400 text-center hover:bg-gray-200" onclick="selectRadio('kar5-{{ $index + 1 }}', '{{ $subSoalItem['karhilang'] }}')">
                                        <input type="radio" id="kar5-{{ $index + 1 }}" name="jawaban-{{ $index + 1 }}" value="{{ $soal->kar5 }}">
                                        <label for="kar5-{{ $index + 1 }}" class="text-lg font-bold pointer-events-none">E</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
                <!-- Tombol Submit -->
                <div class="flex justify-center flex-grow">
                    <button id="submitButton" class="w-1/5 text-center bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 px-4 py-2 rounded mx-5">Submit</button>
                </div>
            </form>
        </div>
        <script>
            var correctAnswers = 0;
            var wrongAnswers = 0;
            function selectRadio(id, correctAnswer) {
                var radio = document.getElementById(id);
                if (radio) {
                    radio.checked = true;
                    if (radio.value === correctAnswer) {
                        correctAnswers++;
                        document.getElementById('correctAnswersInput').value = correctAnswers;
                    } else if (radio.value !== correctAnswer) {
                        wrongAnswers++;
                        document.getElementById('wrongAnswersInput').value = wrongAnswers;
                    }
                }
            }
            document.addEventListener("DOMContentLoaded", function() {
                const startTime = localStorage.getItem('timerStartTime');
                let timeRemaining = 60;
                if (startTime) {
                    const elapsedTime = Math.floor((Date.now() - parseInt(startTime)) / 1000);
                    timeRemaining = Math.max(timeRemaining - elapsedTime, 0);
                } else {
                    localStorage.clear();
                    localStorage.setItem('timerStartTime', Date.now());
                }
                const timerElement = document.getElementById('timer');
                function updateTimerDisplay() {
                    const minutes = Math.floor(timeRemaining / 60);
                    const seconds = timeRemaining % 60;
                    timerElement.textContent = `${minutes} : ${seconds < 10 ? '0' : ''}${seconds}`;
                }
                function submitForm() {
                    document.getElementById('jawabanForm').submit();
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
            document.getElementById('submitButton').addEventListener('click', function () {
                localStorage.clear();
                document.getElementById('jawabanForm').submit();
            });
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        </script>
    </body>
</html>
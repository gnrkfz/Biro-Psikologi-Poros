<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body style="width: 100%; height: 100%; font-family: 'Times New Roman', Times, serif;">
        <h1 style="text-align: center; font-size: 2rem; font-weight: bold; margin-bottom: 3rem;">DETAIL JAWABAN</h1>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center; font-size: 12px;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 5px;  width: 5%;">NO</th>
                    <th style="border: 1px solid black; padding: 5px;  width: 65%;">PERTANYAAN</th>
                    <th style="border: 1px solid black; padding: 5px;  width: 15%;">JAWABAN KLIEN</th>
                    <th style="border: 1px solid black; padding: 5px;  width: 15%;">KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
            @foreach($soals as $index => $soal)
                @php
                    $jawaban = $jawabanteskecerdasan[$index];
                @endphp
                <tr>
                    <th style="border: 1px solid black; padding: 5px;">{{ $index + 1 }}</th>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">
                        {{ $soal->pertanyaan }} <br>
                        A. {{ $soal->opsi1 }} <br>
                        B. {{ $soal->opsi2 }} <br>
                        C. {{ $soal->opsi3 }} <br>
                        D. {{ $soal->opsi4 }} <br>
                        E. {{ $soal->opsi5 }}
                    </td>
                    <td style="border: 1px solid black; padding: 5px; text-align: left;">{{ $jawaban->jawabanklien }}</td>
                    <td style="border: 1px solid black; padding: 5px; text-align: center; color: @if($jawaban->benarsalah == 'Benar') green @elseif($jawaban->benarsalah == 'Salah') red @else black @endif;">
                        {{ $jawaban->benarsalah }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>
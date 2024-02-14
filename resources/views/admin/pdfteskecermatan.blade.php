<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body style="width: 100%; height: 100%; font-family: 'Times New Roman', Times, serif;">
        <h1 style="text-align: center; font-size: 2rem; font-weight: bold; margin-bottom: 3rem;">PSIKOGRAM</h1>
        <div>
            <div style="width: 50%; float: left;">
                <div style="width: 15%; margin-bottom: 1rem;  float: left;">
                    <h2 style="font-weight: bold; font-size: 1rem;">ID </h2>
                    <h2 style="font-weight: bold; font-size: 1rem;">NAMA </h2>
                </div>
                <div style="width: 85%; margin-bottom: 1rem;  float: right;">
                    <h2 style="font-weight: bold; font-size: 1rem;">: {{ $formtes->id }}</h2>
                    <h2 style="font-weight: bold; font-size: 1rem;">: {{ $klien->nama }}</h2>
                </div>
            </div>
            <div style="width: 50%; margin-bottom: 1rem;  float: right;">
                <div style="width: 35%; margin-bottom: 1rem;  float: left;">
                    <h2 style="font-weight: bold; font-size: 1rem;">TES</h2>
                    <h2 style="font-weight: bold; font-size: 1rem;">TANGGAL TES</h2>
                </div>
                <div style="width: 65%; margin-bottom: 1rem;  float: right;">
                    <h2 style="font-weight: bold; font-size: 1rem;">: {{ $formtes->jenistest }}</h2>
                    <h2 style="font-weight: bold; font-size: 1rem;">: {{ date('d-m-Y', strtotime($formtes->tanggaltes)) }}</h2>
                </div>
            </div>
        </div>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center; font-size: 12px;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 15px; width: 40%;">SESI</th>
                    <th style="border: 1px solid black; padding: 15px; width: 20%;">BENAR</th>
                    <th style="border: 1px solid black; padding: 15px; width: 20%;">SALAH</th>
                    <th style="border: 1px solid black; padding: 15px; width: 20%;">TAK TERJAWAB</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jawabanteskecermatan as $index => $jawaban)
                <tr>
                    <th style="border: 1px solid black; padding: 10px;">Sesi {{ $jawaban->sesi }}</th>
                    <td style="border: 1px solid black; padding: 10px;">{{ $jawaban->benar }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ $jawaban->salah }}</td>
                    <td style="border: 1px solid black; padding: 10px;">{{ 50 - ($jawaban->benar + $jawaban->salah) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h2 style="font-weight: bold; font-size: 1rem; margin-top: 3rem;">NILAI AKHIR &nbsp;&nbsp;: {{ $jawabanteskecermatan->where('idformtes', $formtes->id)->sum('benar') }}</h2>
        <h2 style="font-weight: bold; font-size: 1rem;">KESIMPULAN &nbsp;:</h2>
    </body>
</html>
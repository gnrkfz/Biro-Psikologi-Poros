<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body style="width: 100%; height: 100%; font-family: 'Times New Roman', Times, serif;">
        <h1 style="text-align: center; font-size: 2rem; font-weight: bold; margin-bottom: 3rem;">PSIKOGRAM</h1>
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
        <h2 style="font-weight: normal; font-size: 1rem; margin-top: 1.5rem;">Total Soal Terjawab : {{ $jawabanteskecerdasan->where('idformtes', $formtes->id)->where('benarsalah', '!=', 'Tak Terjawab')->count() }}</h2>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; width: 20%; padding: 10px;">&nbsp;</th>
                    <th style="border: 1px solid black; width: 20%;">Aritmatika</th>
                    <th style="border: 1px solid black; width: 20%;">Logis</th>
                    <th style="border: 1px solid black; width: 20%;">Verbal</th>
                    <th style="border: 1px solid black; width: 20%;">Non Verbal</th>
                    <th style="border: 1px solid black; width: 20%;">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="border: 1px solid black; text-align: left; padding: 10px;">Benar</th>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Aritmatika')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Logis')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Verbal')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('kategorisoal', 'Non Verbal')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->count() }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid black; text-align: left; padding: 10px;">Salah</th>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Aritmatika')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Logis')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Verbal')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('kategorisoal', 'Non Verbal')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->count() }}</td>
                </tr>
                <tr>
                    <th style="border: 1px solid black; text-align: left; padding: 10px;">Tak Terjawab</th>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Aritmatika')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Logis')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Verbal')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('kategorisoal', 'Non Verbal')->count() }}</td>
                    <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->count() }}</td>
                </tr>
            </tbody>
        </table>
        <div>
        <div style="display: flex; justify-content: center;">
            <div style="width: 48.75%; float: left;">
                <h2 style="font-weight: normal; font-size: 1rem;">Kemampuan Aritmatika</h2>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; width: 25%; padding: 5px;">&nbsp;</th>
                            <th style="border: 1px solid black; width: 25%;">Level 1</th>
                            <th style="border: 1px solid black; width: 25%;">Level 2</th>
                            <th style="border: 1px solid black; width: 25%;">Level 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Benar</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Aritmatika')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Aritmatika')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Aritmatika')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Salah</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Aritmatika')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Aritmatika')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Aritmatika')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Tak Terjawab</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Aritmatika')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Aritmatika')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Aritmatika')->count() }}</td><!-- Your table content here -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width: 48.75%; float: right;">
                <h2 style="font-weight: normal; font-size: 1rem;">Berpikir Logis</h2>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; width: 25%; padding: 5px;">&nbsp;</th>
                            <th style="border: 1px solid black; width: 25%;">Level 1</th>
                            <th style="border: 1px solid black; width: 25%;">Level 2</th>
                            <th style="border: 1px solid black; width: 25%;">Level 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Benar</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Logis')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Logis')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Logis')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Salah</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Logis')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Logis')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Logis')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Tak Terjawab</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Logis')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Logis')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Logis')->count() }}</td><!-- Your table content here -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="display: flex; justify-content: center;">
            <div style="width: 48.75%; float: left;">
                <h2 style="font-weight: normal; font-size: 1rem;">Kemampuan Verbal</h2>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; width: 25%; padding: 5px;">&nbsp;</th>
                            <th style="border: 1px solid black; width: 25%;">Level 1</th>
                            <th style="border: 1px solid black; width: 25%;">Level 2</th>
                            <th style="border: 1px solid black; width: 25%;">Level 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Benar</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Verbal')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Salah</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Verbal')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Tak Terjawab</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Verbal')->count() }}</td><!-- Your table content here -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="width: 48.75%; float: right;">
                <h2 style="font-weight: normal; font-size: 1rem;">Kemampuan Analisa Non Verbal</h2>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid black; text-align: center; font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; width: 25%; padding: 5px;">&nbsp;</th>
                            <th style="border: 1px solid black; width: 25%;">Level 1</th>
                            <th style="border: 1px solid black; width: 25%;">Level 2</th>
                            <th style="border: 1px solid black; width: 25%;">Level 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Benar</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 1)->where('kategorisoal', 'Non Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 2)->where('kategorisoal', 'Non Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Benar')->where('levelsoal', 3)->where('kategorisoal', 'Non Verbal')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Salah</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 1)->where('kategorisoal', 'Non Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 2)->where('kategorisoal', 'Non Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Salah')->where('levelsoal', 3)->where('kategorisoal', 'Non Verbal')->count() }}</td><!-- Your table content here -->
                        </tr>
                        <tr>
                            <th style="border: 1px solid black; text-align: left; padding: 5px;">Tak Terjawab</th>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 1)->where('kategorisoal', 'Non Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 2)->where('kategorisoal', 'Non Verbal')->count() }}</td>
                            <td style="border: 1px solid black;">{{ $jawabanteskecerdasan->where('benarsalah', 'Tak Terjawab')->where('levelsoal', 3)->where('kategorisoal', 'Non Verbal')->count() }}</td><!-- Your table content here -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <h2 style="font-weight: bold; font-size: 1rem; margin-top: 3rem;">NILAI AKHIR &nbsp;&nbsp;: {{ $jawabanteskecerdasan->where('idformtes', $formtes->id)->where('benarsalah', 'Benar')->count() }}</h2>
        <h2 style="font-weight: bold; font-size: 1rem;">KESIMPULAN &nbsp;:</h2>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemasukan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 14px;
        }
        h1 {
            text-align: center;
            margin-bottom: 5px;
        }
        h2 {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .date-range {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-row td {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        hr {
            border: 0;
            border-top: 1px solid #000;
            margin: 10px auto;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>LAPORAN PEMASUKAN</h1>
    <h2>BADAN PERTANAHAN NASIONAL<br>KABUPATEN SUMENEP</h2>
    <hr>
    <div class="date-range">
        @if($start_date && $end_date)
            <p>Tanggal {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} sampai {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</p>
        @elseif($year)
            <p>Tahun {{ $year }}</p>
        @else
            <p>Semua Data Pemasukan</p>
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; $totalPemasukan = 0; @endphp
            @foreach ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>@currency($item->jumlah)</td>
                    @php $totalPemasukan += $item->jumlah; @endphp
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3"><strong>Total Pemasukan</strong></td>
                <td><b>@currency($totalPemasukan)</b></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

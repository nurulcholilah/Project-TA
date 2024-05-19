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
            font-size: 12px;
        }
        h2 {
            text-align: center;
            margin-bottom: 1px;
        }
        .date-range {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h2>LAPORAN PEMASUKAN<br>BADAN PERTANAHAN NASIONAL<br>KABUPATEN SUMENEP</h2>
    <div class="date-range">
        @if($start_date && $end_date)
            <p>Periode {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} sampai {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
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
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>@currency($item->jumlah)</td>
                    @php $totalPemasukan += $item->jumlah; @endphp
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Total Pemasukan</th>
                <td><strong>@currency($totalPemasukan)</strong></td>
            </tr>
            @if ($saldo)
                <tr>
                    <th colspan="3" style="text-align: right;">Sisa Saldo</th>
                    <td><strong>@currency($saldo)</strong></td>
                </tr>
            @endif
        </tfoot>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 5mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }

        h1, h2, .date-range {
            text-align: center;
            margin: 5px 0;
        }

        h1 {
            margin-bottom: 5px;
        }

        h2 {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .date-range {
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
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

        img {
            max-width: 50px;
        }
    </style>
</head>

<body>
    <h1>LAPORAN PENGELUARAN</h1>
    <h2>BADAN PERTANAHAN NASIONAL<br>KABUPATEN SUMENEP</h2>
    <hr>
    <div class="date-range">
        @if($start_date && $end_date)
        <p>Tanggal {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} sampai {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</p>
        @elseif($year)
        <p>Tahun {{ $year }}</p>
        @else
        <p>Semua Data Pengeluaran</p>
        @endif
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nota</th>
                    <th>Kode Akun</th>
                    <th>Kategori</th>
                    <th>Uraian</th>
                    <th>Penerima</th>
                    <th>Jumlah</th>
                    <th>SPJ</th>
                    <th>Tidak SPJ</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; $totalPengeluaran = 0; @endphp
                @foreach ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td>
                        <img src="{{ public_path('assets/images/file/' . $item->file) }}" alt="{{ $item->file }}" class="img-fluid">
                    </td>
                    <td>{{ $item->kode_akun }}</td>
                    <td>{{ $item->kategori ? $item->kategori->keterangan : 'Tidak ditemukan' }}</td>
                    <td>{{ $item->uraian }}</td>
                    <td>{{ $item->penerima }}</td>
                    <td>@currency($item->jumlah)</td>
                    <td>@currency($item->spj)</td>
                    <td>@currency($item->tdspj)</td>
                    @php $totalPengeluaran += $item->jumlah; @endphp
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <th colspan="7"><strong>Total Pengeluaran</strong></th>
                    <td colspan="3"><b>@currency($totalPengeluaran)</b></td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>

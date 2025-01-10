<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Kendaraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Peminjaman</h1>
    <h3>Periode: {{ $start_date }} sampai {{ $end_date }}</h3>

    @php
        $groupedHistories = $histories->groupBy('tanggal_pinjam');
    @endphp

    @foreach ($groupedHistories as $date => $group)
        <h3>Tanggal: {{ $date }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Selesai</th>
                    <th>Kegiatan</th>
                    <th>Kendaraan</th>
                    <th>Sopir</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $history)
                    <tr>
                        <td>{{ $history->name }}</td>
                        <td>{{ $history->nip }}</td>
                        <td>{{ $history->tanggal_pinjam }}</td>
                        <td>{{ $history->selesai_pinjam }}</td>
                        <td>{{ $history->kegiatan }}</td>
                        <td>{{ $history->car->name }}</td>
                        <td>{{ $history->sopir->name ?? '-' }}</td>
                        <td>{{ $history->catatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
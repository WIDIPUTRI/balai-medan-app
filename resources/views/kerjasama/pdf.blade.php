<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Kerja Sama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 5px 6px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<h2>Laporan Data Kerja Sama</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Jenis Kerja Sama</th>
            <th>Satker</th>
            <th>Mitra</th>
            <th>Kategori Mitra</th>
            <th>Cakupan Kerja Sama</th>
            <th>Status</th>
            <th>No Kerja Sama</th>
            <th>Tentang</th>
            <th>Tgl Mulai</th>
            <th>Tgl Akhir</th>
            <th>Dok. Scan</th>
            <th>Dok. Fisik</th>
            <th>Keterangan</th>
            <th>Implementasi & Evaluasi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->jenis_kerja_sama }}</td>
            <td>{{ $item->satker }}</td>
            <td>{{ $item->mitra }}</td>
            <td>{{ $item->kategori_mitra }}</td>
            <td>{{ $item->cakupan_kerja_sama }}</td>
            <td>{{ $item->status }}</td>
            <td>{{ $item->no_kerja_sama }}</td>
            <td>{{ $item->tentang }}</td>
            <td>{{ $item->tgl_mulai }}</td>
            <td>{{ $item->tgl_akhir }}</td>
            <td>{{ $item->dok_scan }}</td>
            <td>{{ $item->dok_fisik }}</td>
            <td>{{ $item->ket }}</td>
            <td>{{ $item->implementasi_evaluasi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Bulanan Anggaran</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; }
        th { background: #f2f2f2; }
        h3 { text-align: center; margin-bottom: 5px; }
    </style>
</head>
<body>
    <h3>LAPORAN BULANAN ANGGARAN<br>
        {{ strtoupper(\Carbon\Carbon::createFromDate($tahun, $bulan)->translatedFormat('F Y')) }}
    </h3>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Program</th>
                <th>Kegiatan</th>
                <th>Akun Belanja</th>
                <th>Uraian</th>
                <th>Nominal (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $t->akunBelanja->kegiatan->program->nama ?? '-' }}</td>
                <td>{{ $t->akunBelanja->kegiatan->nama ?? '-' }}</td>
                <td>{{ $t->akunBelanja->nama ?? '-' }}</td>
                <td>{{ $t->uraian }}</td>
                <td style="text-align:right">{{ number_format($t->nominal, 2, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6" style="text-align:right; font-weight:bold;">TOTAL</td>
                <td style="text-align:right; font-weight:bold;">{{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Realisasi Anggaran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .badge {
            background: #e0f2fe;
            padding: 2px 5px;
            border-radius: 4px;
            font-size: 10px;
            color: #0369a1;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Transaksi Realisasi Anggaran</h2>
        @if(request('bulan'))
            <p>Periode: {{ date('F Y', strtotime(request('bulan'))) }}</p>
        @else
            <p>Periode: Semua Data</p>
        @endif
        <p>Dicetak pada: {{ date('d M Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 30%">Akun Belanja</th>
                <th style="width: 35%">Keterangan</th>
                <th style="width: 20%" class="text-right">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
                <tr>
                    <td>{{ $trx->tanggal->format('d/m/Y') }}</td>
                    <td>
                        <strong>{{ $trx->anggaran->kode }}</strong><br>
                        {{ $trx->anggaran->uraian }}
                    </td>
                    <td>{{ $trx->keterangan }}</td>
                    <td class="text-right">{{ number_format($trx->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #f9fafb; font-weight: bold;">
                <td colspan="3" class="text-right">Total Realisasi</td>
                <td class="text-right">{{ number_format($transactions->sum('jumlah'), 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
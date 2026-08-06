<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Toko</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            font-size: 11px;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
        }
        .info span {
            margin-right: 20px;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 11px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            text-align: right;
            margin-top: 30px;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DAFTAR TOKO</h1>
        <p>Sistem Inventory POS</p>
    </div>

    <div class="info">
        <span>Tanggal Cetak: {{ date('d/m/Y') }}</span>
        <span>Total Data: {{ $stores->count() }} Toko</span>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Nama Toko</th>
                <th width="30%">Alamat</th>
                <th width="10%">Tahun Berdiri</th>
                <th width="15%">Nama Admin</th>
                <th width="15%">Nama Kasir</th>
                <th width="5%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stores as $index => $store)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->address }}</td>
                <td class="text-center">{{ $store->year_established }}</td>
                <td>{{ $store->admin_name }}</td>
                <td>{{ $store->cashier_name }}</td>
                <td class="text-center">{{ $store->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data toko</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .header p {
            margin: 3px 0;
            font-size: 10px;
            color: #666;
        }
        .info {
            margin-bottom: 15px;
        }
        .info span {
            margin-right: 15px;
            font-size: 9px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            font-size: 8px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
            font-size: 9px;
        }
        .summary {
            margin-top: 15px;
            font-size: 9px;
        }
        .summary td {
            padding: 3px 5px;
        }
        .grand-total {
            font-weight: bold;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENJUALAN</h1>
        <p>Sistem Inventory POS</p>
    </div>

    <div class="info">
        <span>Tanggal Cetak: {{ date('d/m/Y') }}</span>
        <span>Total Transaksi: {{ $sales->count() }}</span>
        @if(request('date_from') && request('date_to'))
            <span>Periode: {{ request('date_from') }} - {{ request('date_to') }}</span>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="10%">Tanggal</th>
                <th width="12%">No. Transaksi</th>
                <th width="15%">Kasir</th>
                <th width="35%">Produk</th>
                <th width="6%">Qty</th>
                <th width="10%">Harga</th>
                <th width="8%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $index => $sale)
                @foreach($sale->items as $item)
                <tr>
                    @if($loop->first)
                    <td class="text-center" rowspan="{{ $sale->items->count() }}">{{ $index + 1 }}</td>
                    @endif
                    <td>{{ $loop->first ? $sale->sale_date->format('d/m/Y') : '' }}</td>
                    <td>{{ $loop->first ? '#' . str_pad($sale->id, 6, '0', STR_PAD_LEFT) : '' }}</td>
                    <td>{{ $loop->first ? $sale->user->name : '' }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->unit_price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data penjualan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <table width="30%" align="right">
            <tr>
                <td colspan="2" class="text-right"><strong>Ringkasan:</strong></td>
            </tr>
            <tr>
                <td>Total Transaksi:</td>
                <td class="text-right">{{ $sales->count() }}</td>
            </tr>
            <tr>
                <td>Total Penjualan:</td>
                <td class="text-right">Rp {{ number_format($sales->sum('total'), 0, ',', '.') }}</td>
            </tr>
            <tr class="grand-total">
                <td>Total Keseluruhan:</td>
                <td class="text-right">Rp {{ number_format($sales->sum('total'), 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
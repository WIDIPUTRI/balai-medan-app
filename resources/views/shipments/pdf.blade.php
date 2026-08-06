<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengiriman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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
            padding: 6px;
            text-align: left;
            font-size: 9px;
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
        .category-badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .gojek { background-color: #00a550; color: white; }
        .jne { background-color: #ff6600; color: white; }
        .jnt { background-color: #e31937; color: white; }
        .pickup { background-color: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENGIRIMAN</h1>
        <p>Sistem Inventory POS</p>
    </div>

    <div class="info">
        <span>Tanggal Cetak: {{ date('d/m/Y') }}</span>
        <span>Total Pengiriman: {{ $shipments->count() }}</span>
        @if(request('date_from') && request('date_to'))
            <span>Periode: {{ request('date_from') }} - {{ request('date_to') }}</span>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="10%">Tanggal Kirim</th>
                <th width="12%">No. Penjualan</th>
                <th width="15%">Kurir</th>
                <th width="35%">Produk</th>
                <th width="8%">Qty</th>
                <th width="10%">Ongkir</th>
                <th width="6%">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shipments as $index => $shipment)
                @foreach($shipment->sale->items as $item)
                <tr>
                    @if($loop->first)
                    <td class="text-center" rowspan="{{ $shipment->sale->items->count() }}">{{ $index + 1 }}</td>
                    @endif
                    <td>{{ $loop->first ? $shipment->shipment_date->format('d/m/Y') : '' }}</td>
                    <td>{{ $loop->first ? '#' . str_pad($shipment->sale->id, 6, '0', STR_PAD_LEFT) : '' }}</td>
                    <td>{{ $loop->first ? '<span class="category-badge ' . $shipment->category . '">' . $shipment->category . '</span>' : '' }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ $loop->first ? 'Rp ' . number_format($shipment->shipping_cost, 0, ',', '.') : '' }}</td>
                    <td class="text-right">{{ $loop->first ? 'Rp ' . number_format($shipment->sale->total, 0, ',', '.') : '' }}</td>
                </tr>
                @endforeach
            @empty
            <tr>
                <td colspan="8" class="text-center">Tidak ada data pengiriman</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px; font-size: 9px;">
        <table width="40%" align="right">
            <tr>
                <td colspan="2" class="text-right"><strong>Ringkasan:</strong></td>
            </tr>
            <tr>
                <td>Total Pengiriman:</td>
                <td class="text-right">{{ $shipments->count() }}</td>
            </tr>
            <tr>
                <td>Total Ongkir:</td>
                <td class="text-right">Rp {{ number_format($shipments->sum('shipping_cost'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Nilai Penjualan:</td>
                <td class="text-right">Rp {{ number_format($shipments->sum(function($shipment) { return $shipment->sale->total ?? 0; }), 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
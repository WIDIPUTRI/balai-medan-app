<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
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
            font-size: 10px;
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
        .status-active {
            color: #28a745;
            font-weight: bold;
        }
        .status-inactive {
            color: #dc3545;
            font-weight: bold;
        }
        .stock-low {
            color: #ffc107;
            font-weight: bold;
        }
        .stock-out {
            color: #dc3545;
            font-weight: bold;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DAFTAR PRODUK</h1>
        <p>Sistem Inventory POS</p>
    </div>

    <div class="info">
        <span>Tanggal Cetak: {{ date('d/m/Y') }}</span>
        <span>Total Data: {{ $products->count() }} Produk</span>
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="12%">Kode</th>
                <th width="25%">Nama Produk</th>
                <th width="15%">Kategori</th>
                <th width="8%">Stok</th>
                <th width="8%">Min Stok</th>
                <th width="13%">Harga Beli</th>
                <th width="13%">Harga Jual</th>
                <th width="5%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td class="text-center @if($product->stock == 0) stock-out @elseif($product->isLowStock()) stock-low @endif">
                    {{ $product->stock }}
                </td>
                <td class="text-center">{{ $product->min_stock }}</td>
                <td class="text-right">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                <td class="text-center">
                    @if($product->is_active)
                        <span class="status-active">Aktif</span>
                    @else
                        <span class="status-inactive">Tidak</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data produk</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
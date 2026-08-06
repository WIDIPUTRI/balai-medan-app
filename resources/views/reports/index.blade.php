@extends('layouts.app')

@section('title', 'Laporan')
@section('page-title', 'Laporan')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="sales" {{ $reportType == 'sales' ? 'selected' : '' }}>Laporan Penjualan</option>
                    <option value="purchases" {{ $reportType == 'purchases' ? 'selected' : '' }}>Laporan Pembelian</option>
                    <option value="inventory" {{ $reportType == 'inventory' ? 'selected' : '' }}>Laporan Inventori</option>
                    <option value="profit_loss" {{ $reportType == 'profit_loss' ? 'selected' : '' }}>Laporan Laba Rugi</option>
                    <option value="login_activity" {{ $reportType == 'login_activity' ? 'selected' : '' }}>Laporan Aktivitas Login</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ $dateTo }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                    <i class="fas fa-chart-bar mr-2"></i>Tampilkan Laporan
                </button>
            </div>
        </form>
    </div>

    @if($reportType == 'sales')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Penjualan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($data['totalSales']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($data['totalRevenue'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-xl text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Penjualan per Tanggal</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah Transaksi</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data['salesByDate'] as $sale)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ \Carbon\Carbon::parse($sale['date'])->isoFormat('dddd, D MMMM Y') }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $sale['count'] }}</td>
                        <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">Rp {{ number_format($sale['total'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">10 Produk Terlaris</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kode Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Produk</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah Terjual</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data['topProducts'] as $item)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item->product_code }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $item->product_name }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $item->total_quantity }}</td>
                        <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if($reportType == 'purchases')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Pembelian</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($data['totalPurchases']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shopping-basket text-xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Biaya</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($data['totalCost'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-money-bill-wave text-xl text-red-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pembelian per Tanggal</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah Transaksi</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data['purchasesByDate'] as $purchase)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ \Carbon\Carbon::parse($purchase['date'])->isoFormat('dddd, D MMMM Y') }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $purchase['count'] }}</td>
                        <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">Rp {{ number_format($purchase['total'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(isset($data['expiredItems']) && $data['expiredItems']->count() > 0)
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Produk dengan Tanggal Kadaluarsa</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kode Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Produk</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tanggal Kadaluarsa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($data['expiredItems'] as $item)
                    <tr class="{{ \Carbon\Carbon::parse($item->expired_date)->isPast() ? 'bg-red-50' : '' }}">
                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item->product_code }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $item->product_name }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 text-sm {{ \Carbon\Carbon::parse($item->expired_date)->isPast() ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                            {{ \Carbon\Carbon::parse($item->expired_date)->isoFormat('D MMMM Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @endif

    @if($reportType == 'inventory')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($data['totalProducts']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-box text-xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Nilai Stok</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($data['totalStockValue'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-xl text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Stok Rendah</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($data['lowStockProducts']) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-xl text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Habis Stok</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($data['outOfStockProducts']) }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times-circle text-xl text-red-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Stok per Kategori</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kategori</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah Produk</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Total Stok</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase">Nilai Stok</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data['stockByCategory'] as $category)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $category['category'] }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $category['products'] }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $category['total_stock'] }}</td>
                        <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">Rp {{ number_format($category['stock_value'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if($reportType == 'profit_loss')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Pendapatan</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($data['totalRevenue'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-arrow-up text-xl text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Biaya</p>
                    <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($data['totalCost'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-arrow-down text-xl text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Laba Kotor</p>
                    <p class="text-2xl font-bold {{ $data['grossProfit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        Rp {{ number_format($data['grossProfit'], 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 {{ $data['grossProfit'] >= 0 ? 'bg-green-100' : 'bg-red-100' }} rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-xl {{ $data['grossProfit'] >= 0 ? 'text-green-600' : 'text-red-600' }}"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Margin Laba</p>
                    <p class="text-2xl font-bold {{ $data['profitMargin'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($data['profitMargin'], 2) }}%
                    </p>
                </div>
                <div class="w-12 h-12 {{ $data['profitMargin'] >= 0 ? 'bg-green-100' : 'bg-red-100' }} rounded-lg flex items-center justify-center">
                    <i class="fas fa-percentage text-xl {{ $data['profitMargin'] >= 0 ? 'text-green-600' : 'text-red-600' }}"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Perbandingan Bulanan</h3>
        <canvas id="profitLossChart" height="80"></canvas>
    </div>
    @endif

    @if($reportType == 'login_activity')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Login</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($data['totalLogins']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-sign-in-alt text-xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">User Unik</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($data['uniqueUsers']) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-xl text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Login per Tanggal</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah Login</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data['loginsByDate'] as $login)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ \Carbon\Carbon::parse($login['date'])->isoFormat('dddd, D MMMM Y') }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $login['count'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Login per User</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah Login</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Login Terakhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data['loginsByUser'] as $user)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user['name'] }}</td>
                        <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $user['count'] }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $user['last_login']->isoFormat('dddd, D MMMM Y HH:mm') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Login Detail</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">User</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Login</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Logout</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($data['logs'] as $log)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $log->user->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $log->login_at->isoFormat('DD/MM/Y HH:mm') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $log->logout_at ? $log->logout_at->isoFormat('DD/MM/Y HH:mm') : '-' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $log->ip_address }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div class="flex justify-end">
        <button onclick="window.print()" class="px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
            <i class="fas fa-print mr-2"></i>Cetak Laporan
        </button>
    </div>
</div>

@if($reportType == 'profit_loss')
@push('scripts')
<script>
const ctx = document.getElementById('profitLossChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($data['salesByMonth']->pluck('month')),
        datasets: [{
            label: 'Pendapatan',
            data: @json($data['salesByMonth']->pluck('revenue')),
            backgroundColor: '#10B981',
        }, {
            label: 'Biaya',
            data: @json($data['purchasesByMonth']->pluck('cost')),
            backgroundColor: '#EF4444',
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
@endpush
@endif
@endsection
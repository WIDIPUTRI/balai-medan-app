@extends('layouts.app')

@section('title', 'Detail Pembelian')
@section('page-title', 'Detail Pembelian')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="mb-6 pb-6 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Detail Pembelian</h2>
                    <p class="text-sm text-gray-600 mt-1">{{ $purchase->purchase_date->isoFormat('dddd, D MMMM Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Nama Toko</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $purchase->store->name }}</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-700 mb-4">Daftar Produk</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kode Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Expired</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase">Harga</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-600 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($purchase->items as $item)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $item->product_code }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900">{{ $item->product_name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $item->expired_date ? $item->expired_date->format('d/m/Y') : '-' }}</td>
                            <td class="px-4 py-3 text-sm text-center text-gray-600">{{ $item->quantity }}</td>
                            <td class="px-4 py-3 text-sm text-right text-gray-600">{{ formatRupiah($item->unit_price) }}</td>
                            <td class="px-4 py-3 text-sm text-right font-medium text-gray-900">{{ formatRupiah($item->subtotal) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-2 mb-6 pb-6 border-b border-gray-200">
            <div class="flex justify-between text-lg font-bold pt-2">
                <span>Total Harga</span>
                <span class="text-primary">{{ formatRupiah($purchase->total) }}</span>
            </div>
        </div>

        @if($purchase->notes)
        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Keterangan</h3>
            <p class="text-sm text-gray-900">{{ $purchase->notes }}</p>
        </div>
        @endif

        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('purchases.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                Kembali
            </a>
            <button onclick="window.print()" class="px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                <i class="fas fa-print mr-2"></i>Cetak
            </button>
        </div>
    </div>
</div>
@endsection
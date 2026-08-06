@extends('layouts.app')

@section('title', 'Daftar Pembelian')
@section('page-title', 'Daftar Pembelian')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Daftar Pembelian</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola data pembelian</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('purchases.exportPdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200">
                <i class="fas fa-file-pdf mr-2"></i>
                Export PDF
            </a>
            <a href="{{ route('purchases.create') }}" class="inline-flex items-center px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pembelian
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode/nama produk..." 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                
                <input type="date" name="date_from" value="{{ request('date_from') }}" placeholder="Dari Tanggal"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">

                <input type="date" name="date_to" value="{{ request('date_to') }}" placeholder="Sampai Tanggal"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">

                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Hari/Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kode Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Expired Produk</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah Produk</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Harga Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($purchases as $purchase)
                        @foreach($purchase->items as $item)
                        <tr class="table-row">
                            @if($loop->first)
                            <td class="px-6 py-4 text-sm text-gray-900" rowspan="{{ $purchase->items->count() }}">
                                {{ $purchase->purchase_date->isoFormat('dddd, D MMMM Y') }}
                            </td>
                            @endif
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->product_code }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->product_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->expired_date ? $item->expired_date->format('d/m/Y') : '-' }}</td>
                            <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-right font-medium text-gray-900">{{ formatRupiah($item->subtotal) }}</td>
                            @if($loop->first)
                            <td class="px-6 py-4 text-sm text-gray-600" rowspan="{{ $purchase->items->count() }}">{{ $purchase->store->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600" rowspan="{{ $purchase->items->count() }}">{{ $purchase->notes ?? '-' }}</td>
                            <td class="px-6 py-4 text-center" rowspan="{{ $purchase->items->count() }}">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('purchases.show', $purchase) }}" class="text-blue-600 hover:text-blue-700" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form id="delete-form-{{ $purchase->id }}" action="{{ route('purchases.destroy', $purchase) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('delete-form-{{ $purchase->id }}')" class="text-red-600 hover:text-red-700" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-8 text-center text-gray-500">Tidak ada data pembelian</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($purchases->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $purchases->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
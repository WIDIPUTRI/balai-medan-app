@extends('layouts.app')

@section('title', 'Daftar Pengiriman')
@section('page-title', 'Daftar Pengiriman')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Daftar Pengiriman</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola data pengiriman</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('shipments.exportPdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200">
                <i class="fas fa-file-pdf mr-2"></i>
                Export PDF
            </a>
            <a href="{{ route('shipments.create') }}" class="inline-flex items-center px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pengiriman
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                
                <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="">Semua Kategori</option>
                    <option value="gojek" {{ request('category') == 'gojek' ? 'selected' : '' }}>Gojek</option>
                    <option value="jne" {{ request('category') == 'jne' ? 'selected' : '' }}>JNE</option>
                    <option value="jnt" {{ request('category') == 'jnt' ? 'selected' : '' }}>JNT</option>
                    <option value="pickup" {{ request('category') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                </select>

                <input type="date" name="date_from" value="{{ request('date_from') }}" placeholder="Dari Tanggal"
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Hari/Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kode Produk</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Total Produk</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Biaya Pengiriman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($shipments as $shipment)
                        @foreach($shipment->sale->items as $item)
                        <tr class="table-row">
                            @if($loop->first)
                            <td class="px-6 py-4 text-sm font-medium text-gray-900" rowspan="{{ $shipment->sale->items->count() }}">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">
                                    {{ strtoupper($shipment->category) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900" rowspan="{{ $shipment->sale->items->count() }}">
                                {{ $shipment->shipment_date->isoFormat('dddd, D MMMM Y') }}
                            </td>
                            @endif
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->product_name }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->product_code }}</td>
                            <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $item->quantity }}</td>
                            @if($loop->first)
                            <td class="px-6 py-4 text-sm text-right font-medium text-gray-900" rowspan="{{ $shipment->sale->items->count() }}">
                                Rp {{ number_format($shipment->shipping_cost, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600" rowspan="{{ $shipment->sale->items->count() }}">{{ $shipment->notes ?? '-' }}</td>
                            <td class="px-6 py-4 text-center" rowspan="{{ $shipment->sale->items->count() }}">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('shipments.edit', $shipment) }}" class="text-blue-600 hover:text-blue-700" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="delete-form-{{ $shipment->id }}" action="{{ route('shipments.destroy', $shipment) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('delete-form-{{ $shipment->id }}')" class="text-red-600 hover:text-red-700" title="Hapus">
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
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">Tidak ada data pengiriman</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($shipments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $shipments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Daftar Produk')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Daftar Produk</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola data produk per kategori</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('products.exportPdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200">
                <i class="fas fa-file-pdf mr-2"></i>
                Export PDF
            </a>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                Tambah Produk
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." 
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            
            <select name="category_id" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            
            <select name="stock_status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Semua Stok</option>
                <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Stok Rendah</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
        </form>
    </div>

    @foreach($categories as $category)
    @php
        $categoryProducts = $products->where('category_id', $category->id);
    @endphp
    @if($categoryProducts->count() > 0)
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Kode Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Produk</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Harga Beli</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-600 uppercase">Harga Jual</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categoryProducts as $product)
                    <tr class="table-row">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $product->code }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 rounded object-cover">
                                @else
                                <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                                @endif
                                <span class="ml-3 text-sm font-medium text-gray-900">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-right text-gray-600">{{ formatRupiah($product->purchase_price) }}</td>
                        <td class="px-6 py-4 text-sm text-right font-medium text-gray-900">{{ formatRupiah($product->selling_price) }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $product->isLowStock() ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $product->notes ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-700" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-form-{{ $product->id }}')" class="text-red-600 hover:text-red-700" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @endforeach

    @if($products->isEmpty())
    <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
        <i class="fas fa-box text-4xl text-gray-300 mb-4"></i>
        <p class="text-gray-500">Tidak ada data produk</p>
    </div>
    @endif

    @if($products->hasPages())
    <div class="bg-white rounded-lg border border-gray-200 px-6 py-4">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
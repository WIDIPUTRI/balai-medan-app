@extends('layouts.app')

@section('title', 'Daftar Toko')
@section('page-title', 'Daftar Toko')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Daftar Toko</h2>
            <p class="text-sm text-gray-600 mt-1">Kelola data toko</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('stores.exportPdf') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition duration-200">
                <i class="fas fa-file-pdf mr-2"></i>
                Export PDF
            </a>
            <a href="{{ route('stores.create') }}" class="inline-flex items-center px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                Tambah Toko
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-4 border-b border-gray-200">
            <form method="GET" class="flex gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari toko..." 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Alamat Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tahun Berdiri</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Admin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama Kasir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($stores as $store)
                    <tr class="table-row">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $store->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $store->address }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $store->year_established }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $store->admin_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $store->cashier_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $store->notes ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{ route('stores.edit', $store) }}" class="text-blue-600 hover:text-blue-700" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form id="delete-form-{{ $store->id }}" action="{{ route('stores.destroy', $store) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete('delete-form-{{ $store->id }}')" class="text-red-600 hover:text-red-700" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">Tidak ada data toko</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($stores->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $stores->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
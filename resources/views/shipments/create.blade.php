@extends('layouts.app')

@section('title', 'Tambah Pengiriman')
@section('page-title', 'Tambah Pengiriman')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form action="{{ route('shipments.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="sale_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Penjualan</label>
                    <select name="sale_id" id="sale_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('sale_id') border-red-500 @enderror">
                        <option value="">Pilih Penjualan</option>
                        @foreach($sales as $sale)
                        <option value="{{ $sale->id }}" {{ old('sale_id') == $sale->id ? 'selected' : '' }}>
                            {{ $sale->sale_date->format('d/m/Y') }} - {{ $sale->store->name }} - Rp {{ number_format($sale->total, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                    @error('sale_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori Pengiriman</label>
                    <select name="category" id="category" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('category') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        <option value="gojek" {{ old('category') == 'gojek' ? 'selected' : '' }}>Gojek</option>
                        <option value="jne" {{ old('category') == 'jne' ? 'selected' : '' }}>JNE</option>
                        <option value="jnt" {{ old('category') == 'jnt' ? 'selected' : '' }}>JNT</option>
                        <option value="pickup" {{ old('category') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                    </select>
                    @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="shipment_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengiriman</label>
                    <input type="date" name="shipment_date" id="shipment_date" value="{{ old('shipment_date', now()->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('shipment_date') border-red-500 @enderror">
                    @error('shipment_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="shipping_cost" class="block text-sm font-medium text-gray-700 mb-2">Biaya Pengiriman</label>
                    <input type="number" name="shipping_cost" id="shipping_cost" value="{{ old('shipping_cost', 0) }}" step="0.01" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('shipping_cost') border-red-500 @enderror">
                    @error('shipping_cost')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea name="notes" id="notes" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
                <a href="{{ route('shipments.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
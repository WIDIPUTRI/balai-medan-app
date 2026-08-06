@extends('layouts.app')

@section('title', 'Tambah Pembelian')
@section('page-title', 'Tambah Pembelian')

@section('content')
<div class="max-w-6xl">
    <form action="{{ route('purchases.store') }}" method="POST" x-data="purchaseForm()">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pilih Produk</h3>
                    
                    <div class="mb-4">
                        <input type="text" x-model="searchProduct" placeholder="Cari produk..." 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-96 overflow-y-auto">
                        @foreach($products as $product)
                        <div x-show="'{{ strtolower($product->name) }} {{ strtolower($product->code) }}'.includes(searchProduct.toLowerCase())" 
                            @click="addItem({{ $product->id }}, '{{ $product->code }}', '{{ $product->name }}', {{ $product->purchase_price }})"
                            class="p-4 border border-gray-200 rounded-lg hover:border-primary cursor-pointer transition duration-200">
                            <div class="flex items-center space-x-3">
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 rounded object-cover">
                                @else
                                <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $product->code }}</p>
                                    <p class="text-sm font-medium text-primary">{{ formatRupiah($product->purchase_price) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pembelian</h3>
                    
                    <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate" x-text="item.name"></p>
                                        <p class="text-xs text-gray-500" x-text="item.code"></p>
                                        <p class="text-xs text-gray-500" x-text="formatRupiah(item.price)"></p>
                                    </div>
                                    <button type="button" @click="removeItem(index)" class="text-red-600 hover:text-red-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <button type="button" @click="decreaseQty(index)" class="w-6 h-6 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300">
                                            <i class="fas fa-minus text-xs"></i>
                                        </button>
                                        <span class="text-sm font-medium w-8 text-center" x-text="item.quantity"></span>
                                        <button type="button" @click="increaseQty(index)" class="w-6 h-6 flex items-center justify-center bg-gray-200 rounded hover:bg-gray-300">
                                            <i class="fas fa-plus text-xs"></i>
                                        </button>
                                    </div>
                                    <input type="date" :name="'items[' + index + '][expired_date]'" placeholder="Tanggal Expired"
                                        class="w-full text-xs px-2 py-1 border border-gray-300 rounded focus:ring-1 focus:ring-primary focus:border-primary">
                                </div>
                                <input type="hidden" :name="'items[' + index + '][product_id]'" :value="item.id">
                                <input type="hidden" :name="'items[' + index + '][quantity]'" :value="item.quantity">
                            </div>
                        </template>
                        <p x-show="items.length === 0" class="text-center text-sm text-gray-500 py-4">Belum ada produk</p>
                    </div>

                    <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-primary" x-text="formatRupiah(total)"></span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" value="{{ now()->format('Y-m-d') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                            <textarea name="notes" rows="2"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"></textarea>
                        </div>

                        <div class="space-y-2">
                            <button type="submit" :disabled="items.length === 0"
                                class="w-full px-4 py-3 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-check mr-2"></i>Simpan Pembelian
                            </button>
                            <a href="{{ route('purchases.index') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-lg text-center text-gray-700 hover:bg-gray-50 transition duration-200">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function purchaseForm() {
    return {
        items: [],
        searchProduct: '',
        
        get total() {
            return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        },
        
        addItem(id, code, name, price) {
            const existingItem = this.items.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.items.push({ id, code, name, price, quantity: 1 });
            }
        },
        
        increaseQty(index) {
            this.items[index].quantity++;
        },
        
        decreaseQty(index) {
            if (this.items[index].quantity > 1) {
                this.items[index].quantity--;
            }
        },
        
        removeItem(index) {
            this.items.splice(index, 1);
        },
        
        formatRupiah(num) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(num);
        },

        formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }
    }
}
</script>
@endpush
@endsection
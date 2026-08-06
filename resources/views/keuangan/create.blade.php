@extends('layouts.app')

@section('title', isset($keuangan) ? 'Edit Transaksi' : 'Tambah Transaksi')
@section('page-title', isset($keuangan) ? 'Edit Transaksi' : 'Tambah Transaksi')

@section('content')
<form action="{{ isset($keuangan) ? route('keuangan.update', $keuangan) : route('keuangan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if(isset($keuangan))
        @method('PUT')
    @endif

    <div>
        <label>Jenis Transaksi</label>
        <select name="type" class="w-full border p-2 rounded">
            <option value="pemasukan" {{ isset($keuangan) && $keuangan->type == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
            <option value="pengeluaran" {{ isset($keuangan) && $keuangan->type == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
        </select>
    </div>

    <div>
        <label>Keterangan</label>
        <input type="text" name="description" value="{{ old('description', $keuangan->description ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Kategori</label>
        <input type="text" name="category" value="{{ old('category', $keuangan->category ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Jumlah (Rp)</label>
        <input type="number" name="amount" step="0.01" value="{{ old('amount', $keuangan->amount ?? '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Tanggal Transaksi</label>
        <input type="date" name="transaction_date" value="{{ old('transaction_date', isset($keuangan) ? $keuangan->transaction_date->format('Y-m-d') : '') }}" class="w-full border p-2 rounded">
    </div>

    <div>
        <label>Bukti (Opsional)</label>
        <input type="file" name="attachment" class="w-full border p-2 rounded">
        @if(isset($keuangan) && $keuangan->attachment)
            <a href="{{ asset('storage/' . $keuangan->attachment) }}" target="_blank" class="text-blue-600 text-sm">Lihat Bukti</a>
        @endif
    </div>

    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
        Simpan
    </button>
</form>
@endsection

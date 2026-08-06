@extends('layouts.app')

@section('title', 'Keuangan')
@section('page-title', 'Manajemen Keuangan')

@section('content')

<div class="flex justify-between items-center mb-4">
    <h2 class="text-xl font-semibold">Daftar Transaksi Keuangan</h2>

    <div class="space-x-2 flex">
        <a href="{{ route('keuangan.create') }}"
           class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark">
            + Tambah Transaksi
        </a>

        <a href="{{ route('keuangan.export.excel') }}"
           class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Export Excel
        </a>

        <a href="{{ route('keuangan.export.pdf') }}"
           class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
            Export PDF
        </a>
    </div>
</div>

<table class="w-full border-collapse border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="border p-2">Tanggal</th>
            <th class="border p-2">Keterangan</th>
            <th class="border p-2">Kategori</th>
            <th class="border p-2">Jenis</th>
            <th class="border p-2">Jumlah</th>
            <th class="border p-2">Dibuat Oleh</th>
            <th class="border p-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($finances as $f)
        <tr class="border-b">
            <td class="p-2">{{ \Carbon\Carbon::parse($f->transaction_date)->format('d/m/Y') }}</td>
            <td class="p-2">{{ $f->description }}</td>
            <td class="p-2">{{ $f->category ?? '-' }}</td>
            <td class="p-2 capitalize">{{ $f->type }}</td>
            <td class="p-2 text-right">Rp {{ number_format($f->amount, 0, ',', '.') }}</td>
            <td class="p-2">{{ $f->user->name }}</td>
            <td class="p-2 text-center">
                <a href="{{ route('keuangan.edit', $f) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('keuangan.destroy', $f) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="p-4 text-center text-gray-500">Belum ada data transaksi</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $finances->links() }}
</div>
@endsection

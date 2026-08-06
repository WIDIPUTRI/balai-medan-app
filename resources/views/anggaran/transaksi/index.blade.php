@extends('layouts.app')
@section('content')
<div class="container">
    <h3>📑 Data Transaksi Anggaran</h3>
    <a href="{{ route('transaksi-anggaran.create') }}" class="btn btn-primary mb-3">+ Tambah Transaksi</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Akun</th>
                <th>Uraian</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $t)
            <tr>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->akunBelanja->nama }}</td>
                <td>{{ $t->uraian }}</td>
                <td>Rp{{ number_format($t->nominal, 0, ',', '.') }}</td>
                <td>{{ $t->keterangan }}</td>
                <td>
                    <a href="{{ route('transaksi-anggaran.edit', $t) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('transaksi-anggaran.destroy', $t) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus transaksi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $transaksis->links() }}
</div>
@endsection

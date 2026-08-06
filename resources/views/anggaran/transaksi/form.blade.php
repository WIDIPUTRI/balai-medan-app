@extends('layouts.app')
@section('content')
<div class="container">
    <h3>{{ isset($transaksi) ? 'Edit' : 'Tambah' }} Transaksi</h3>
    <form method="POST" action="{{ isset($transaksi) ? route('transaksi-anggaran.update', $transaksi) : route('transaksi-anggaran.store') }}">
        @csrf
        @if(isset($transaksi)) @method('PUT') @endif

        <div class="mb-3">
            <label>Akun Belanja</label>
            <select name="akun_belanja_id" class="form-control">
                @foreach($akunBelanjas as $a)
                <option value="{{ $a->id }}" {{ isset($transaksi) && $transaksi->akun_belanja_id == $a->id ? 'selected' : '' }}>
                    {{ $a->kode }} - {{ $a->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Uraian</label>
            <input type="text" name="uraian" value="{{ old('uraian', $transaksi->uraian ?? '') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nominal (Rp)</label>
            <input type="number" name="nominal" value="{{ old('nominal', $transaksi->nominal ?? 0) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $transaksi->keterangan ?? '') }}</textarea>
        </div>

        <button class="btn btn-success">{{ isset($transaksi) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection

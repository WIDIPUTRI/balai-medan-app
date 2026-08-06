@extends('layouts.app')
@section('content')
<div class="container">
    <h3>{{ isset($akunBelanja) ? 'Edit' : 'Tambah' }} Akun Belanja</h3>
    <form method="POST" action="{{ isset($akunBelanja) ? route('akun-belanja.update', $akunBelanja) : route('akun-belanja.store') }}">
        @csrf
        @if(isset($akunBelanja)) @method('PUT') @endif

        <div class="mb-3">
            <label>Komponen</label>
            <select name="komponen_id" class="form-control">
                @foreach($komponens as $k)
                <option value="{{ $k->id }}" {{ isset($akunBelanja) && $akunBelanja->komponen_id == $k->id ? 'selected' : '' }}>
                    {{ $k->kode }} - {{ $k->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Kode</label>
            <input type="text" name="kode" value="{{ old('kode', $akunBelanja->kode ?? '') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ old('nama', $akunBelanja->nama ?? '') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Pagu (Rp)</label>
            <input type="number" name="pagu" value="{{ old('pagu', $akunBelanja->pagu ?? 0) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Realisasi (Rp)</label>
            <input type="number" name="realisasi" value="{{ old('realisasi', $akunBelanja->realisasi ?? 0) }}" class="form-control">
        </div>
        <button class="btn btn-success">{{ isset($akunBelanja) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection

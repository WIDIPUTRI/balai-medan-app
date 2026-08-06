@extends('layouts.app')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">Edit Kerja Sama</h2>

    <form action="{{ route('kerjasama.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- JENIS KERJA SAMA -->
            <div>
                <label class="block font-semibold mb-1">Jenis Kerja Sama</label>
                <input type="text" name="jenis_kerja_sama"
                       value="{{ $data->jenis_kerja_sama }}"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <!-- SATKER -->
            <div>
                <label class="block font-semibold mb-1">Satker</label>
                <input type="text" name="satker"
                       value="{{ $data->satker }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- MITRA -->
            <div>
                <label class="block font-semibold mb-1">Mitra</label>
                <input type="text" name="mitra"
                       value="{{ $data->mitra }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- KATEGORI MITRA -->
            <div>
                <label class="block font-semibold mb-1">Kategori Mitra</label>
                <input type="text" name="kategori_mitra"
                       value="{{ $data->kategori_mitra }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- CAKUPAN -->
            <div>
                <label class="block font-semibold mb-1">Cakupan Kerja Sama</label>
                <input type="text" name="cakupan_kerja_sama"
                       value="{{ $data->cakupan_kerja_sama }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- STATUS -->
            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2">
                    <option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Tidak Aktif" {{ $data->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="Proses" {{ $data->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                </select>
            </div>

            <!-- NO KERJA SAMA -->
            <div>
                <label class="block font-semibold mb-1">Nomor Kerja Sama</label>
                <input type="text" name="no_kerja_sama"
                       value="{{ $data->no_kerja_sama }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- TENTANG -->
            <div>
                <label class="block font-semibold mb-1">Tentang</label>
                <input type="text" name="tentang"
                       value="{{ $data->tentang }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- TGL MULAI -->
            <div>
                <label class="block font-semibold mb-1">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai"
                       value="{{ $data->tgl_mulai }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- TGL AKHIR -->
            <div>
                <label class="block font-semibold mb-1">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir"
                       value="{{ $data->tgl_akhir }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- DOKUMEN SCAN -->
            <div>
                <label class="block font-semibold mb-1">Dokumen Scan</label>

                <input type="file" name="dok_scan"
                       class="w-full border rounded-lg px-3 py-2">

                @if($data->dok_scan)
                    <p class="text-sm mt-1">File saat ini:
                        <a href="{{ asset('storage/' . $data->dok_scan) }}" target="_blank" class="text-blue-600 underline">
                            Lihat Dokumen
                        </a>
                    </p>
                @endif
            </div>

            <!-- DOK FISIK -->
            <div>
                <label class="block font-semibold mb-1">Dokumen Fisik</label>
                <input type="text" name="dok_fisik"
                       value="{{ $data->dok_fisik }}"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- KETERANGAN -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan"
                          class="w-full border rounded-lg px-3 py-2"
                          rows="3">{{ $data->keterangan }}</textarea>
            </div>

            <!-- IMPLEMENTASI -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Implementasi & Evaluasi</label>
                <textarea name="implementasi"
                          class="w-full border rounded-lg px-3 py-2"
                          rows="3">{{ $data->implementasi }}</textarea>
            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('kerjasama.index') }}"
               class="px-4 py-2 border rounded-lg">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg">
                Update
            </button>
        </div>

    </form>

</div>
@endsection

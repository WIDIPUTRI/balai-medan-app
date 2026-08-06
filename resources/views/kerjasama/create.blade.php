@extends('layouts.app')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">Tambah Kerja Sama</h2>

    <form action="{{ route('kerjasama.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- JENIS KERJA SAMA -->
            <div>
                <label class="block font-semibold mb-1">Jenis Kerja Sama</label>
                <input type="text" name="jenis_kerja_sama"
                       class="w-full border rounded-lg px-3 py-2"
                       required>
            </div>

            <!-- SATKER -->
            <div>
                <label class="block font-semibold mb-1">Satker</label>
                <input type="text" name="satker"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- MITRA -->
            <div>
                <label class="block font-semibold mb-1">Mitra</label>
                <input type="text" name="mitra"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- KATEGORI MITRA -->
            <div>
                <label class="block font-semibold mb-1">Kategori Mitra</label>
                <input type="text" name="kategori_mitra"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- CAKUPAN KERJA SAMA -->
            <div>
                <label class="block font-semibold mb-1">Cakupan Kerja Sama</label>
                <input type="text" name="cakupan_kerja_sama"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- STATUS -->
            <div>
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="w-full border rounded-lg px-3 py-2">
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Proses">Proses</option>
                </select>
            </div>

            <!-- NO KERJA SAMA -->
            <div>
                <label class="block font-semibold mb-1">Nomor Kerja Sama</label>
                <input type="text" name="no_kerja_sama"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- TENTANG -->
            <div>
                <label class="block font-semibold mb-1">Tentang</label>
                <input type="text" name="tentang"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- TGL MULAI -->
            <div>
                <label class="block font-semibold mb-1">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- TGL AKHIR -->
            <div>
                <label class="block font-semibold mb-1">Tanggal Akhir</label>
                <input type="date" name="tgl_akhir"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- DOKUMEN SCAN -->
            <div>
                <label class="block font-semibold mb-1">Dokumen Scan</label>
                <input type="file" name="dok_scan"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- DOKUMEN FISIK -->
            <div>
                <label class="block font-semibold mb-1">Dokumen Fisik</label>
                <input type="text" name="dok_fisik"
                       class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- KETERANGAN -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Keterangan</label>
                <textarea name="keterangan"
                          class="w-full border rounded-lg px-3 py-2"
                          rows="3"></textarea>
            </div>

            <!-- IMPLEMENTASI -->
            <div class="md:col-span-2">
                <label class="block font-semibold mb-1">Implementasi & Evaluasi</label>
                <textarea name="implementasi"
                          class="w-full border rounded-lg px-3 py-2"
                          rows="3"></textarea>
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
                Simpan
            </button>
        </div>

    </form>

</div>
@endsection

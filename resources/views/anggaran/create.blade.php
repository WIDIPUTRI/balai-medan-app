@extends('layouts.app')

@section('title', 'Tambah Anggaran')
@section('page-title', 'Tambah Data Anggaran')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="bg-indigo-600 text-white px-6 py-4 text-lg font-semibold">
                <i class="fa-solid fa-plus mr-2"></i>Tambah Data Anggaran
            </div>

            <form action="{{ route('anggaran.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    {{-- Level --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Level <span
                                class="text-red-500">*</span></label>
                        <select name="level" id="level" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="program">Program</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="sub_kegiatan">Sub Kegiatan</option>
                            <option value="akun">Akun Belanja</option>
                        </select>
                    </div>

                    {{-- Parent --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Parent</label>
                        <select name="parent_id" id="parent_id"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Tidak Ada (Root) --</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" class="{{ $parent->level_color }}">
                                    {{ str_repeat('— ', $parent->indent_level) }}[{{ strtoupper($parent->level) }}]
                                    {{ $parent->kode }} - {{ $parent->uraian }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kode --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kode" required placeholder="GK.7448"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Uraian --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Uraian <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="uraian" required placeholder="Nama Program/Kegiatan/Akun"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- Financial Fields (for akun level) --}}
                <div class="bg-orange-50 rounded-lg p-4 space-y-4">
                    <h3 class="font-semibold text-orange-700">
                        <i class="fa-solid fa-coins mr-2"></i>Nilai Anggaran (khusus level Akun)
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Pagu Revisi</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="pagu_revisi" placeholder="0"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Limit Pagu</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="limit_pagu" placeholder="0"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Realisasi Lalu</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="realisasi_lalu" placeholder="0"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Realisasi Ini</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="realisasi_ini" placeholder="0"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('anggaran.index') }}"
                        class="px-6 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        <i class="fa-solid fa-save mr-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
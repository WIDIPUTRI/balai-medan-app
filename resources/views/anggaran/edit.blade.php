@extends('layouts.app')

@section('title', 'Edit Anggaran')
@section('page-title', 'Edit Data Anggaran')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="bg-indigo-600 text-white px-6 py-4 text-lg font-semibold">
                <i class="fa-solid fa-edit mr-2"></i>Edit Data Anggaran
            </div>

            {{-- Level Badge --}}
            <div class="px-6 py-3 bg-gray-50 border-b flex items-center gap-3">
                <span
                    class="px-3 py-1 rounded-full text-sm font-medium
                    {{ $anggaran->level == 'program' ? 'bg-cyan-100 text-cyan-700' :
        ($anggaran->level == 'kegiatan' ? 'bg-blue-100 text-blue-700' :
            ($anggaran->level == 'sub_kegiatan' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700')) }}">
                    {{ strtoupper($anggaran->level) }}
                </span>
                @if($anggaran->parent)
                    <span class="text-gray-500 text-sm">
                        <i class="fa-solid fa-arrow-right mx-2"></i>
                        Parent: <strong>{{ $anggaran->parent->kode }}</strong> - {{ $anggaran->parent->uraian }}
                    </span>
                @endif
            </div>

            <form action="{{ route('anggaran.update', $anggaran->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    {{-- Kode --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kode" value="{{ $anggaran->kode }}" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    {{-- Uraian --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Uraian <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="uraian" value="{{ $anggaran->uraian }}" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                {{-- Financial Fields --}}
                <div class="bg-orange-50 rounded-lg p-4 space-y-4">
                    <h3 class="font-semibold text-orange-700">
                        <i class="fa-solid fa-coins mr-2"></i>Nilai Anggaran
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Pagu Revisi</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="pagu_revisi"
                                    value="{{ number_format($anggaran->pagu_revisi, 0, '', '') }}"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Limit Pagu</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="limit_pagu"
                                    value="{{ number_format($anggaran->limit_pagu, 0, '', '') }}"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Realisasi Lalu</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="realisasi_lalu"
                                    value="{{ number_format($anggaran->realisasi_lalu, 0, '', '') }}"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Realisasi Ini</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                                <input type="text" name="realisasi_ini"
                                    value="{{ number_format($anggaran->realisasi_ini, 0, '', '') }}"
                                    class="w-full border rounded-lg pl-10 pr-3 py-2 focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>
                    </div>

                    {{-- Calculated Fields (readonly) --}}
                    <div class="grid grid-cols-3 gap-4 pt-4 border-t">
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">Realisasi Total</label>
                            <div class="text-lg font-bold text-green-600">
                                Rp {{ number_format($anggaran->realisasi_total, 0, ',', '.') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">Persentase</label>
                            <div class="text-lg font-bold text-blue-600">
                                {{ $anggaran->persen_realisasi }}%
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-500 mb-1">Sisa Anggaran</label>
                            <div
                                class="text-lg font-bold {{ $anggaran->sisa_anggaran >= 0 ? 'text-orange-600' : 'text-red-600' }}">
                                Rp {{ number_format($anggaran->sisa_anggaran, 0, ',', '.') }}
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
                        <i class="fa-solid fa-save mr-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
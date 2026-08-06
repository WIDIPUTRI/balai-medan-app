@extends('layouts.app')

@section('page-title', 'Data Kerja Sama')

@section('content')
    <div class="p-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6 w-full">
            <h2 class="text-xl font-semibold">Data Kerjasama</h2>

            <div class="flex items-center gap-3">

                {{-- DROPDOWN EXPORT / IMPORT --}}
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button @click="open = !open"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow flex items-center">
                        Export/Import
                        <i class="fa-solid fa-chevron-down ml-2"></i>
                    </button>

                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md border py-1 z-50">
                        {{-- Export PDF --}}
                        <a href="{{ route('kerjasama.exportPdf') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Export PDF
                        </a>

                        {{-- Import Excel --}}
                        <form action="{{ route('kerjasama.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="block px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                Import Excel
                                <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>
                    </div>
                </div>

                {{-- TAMBAH KERJASAMA --}}
                <a href="{{ route('kerjasama.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    + Tambah Kerjasama
                </a>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white shadow rounded-xl overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr class="text-left">
                        <th class="p-3">NO</th>
                        <th class="p-3">JENIS KERJA SAMA</th>
                        <th class="p-3">SATKER</th>
                        <th class="p-3">MITRA</th>
                        <th class="p-3">KATEGORI MITRA</th>
                        <th class="p-3">CAKUPAN</th>
                        <th class="p-3">STATUS</th>
                        <th class="p-3">NO KS</th>
                        <th class="p-3">TENTANG</th>
                        <th class="p-3">TGL MULAI</th>
                        <th class="p-3">TGL AKHIR</th>
                        <th class="p-3">DOK. SCAN</th>
                        <th class="p-3">DOK. FISIK</th>
                        <th class="p-3">KET</th>
                        <th class="p-3">IMPLEMENTASI</th>
                        <th class="p-3 text-center sticky right-0 bg-gray-100 z-10 border-l shadow-sm min-w-[100px]">AKSI
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $row)
                                <tr class="border-b hover:bg-gray-50 group">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $row->jenis_kerja_sama }}</td>
                                    <td class="p-3">{{ $row->satker }}</td>
                                    <td class="p-3 font-medium">{{ $row->mitra }}</td>
                                    <td class="p-3">{{ $row->kategori_mitra }}</td>
                                    <td class="p-3">{{ $row->cakupan_kerja_sama }}</td>
                                    <td class="p-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                            {{ $row->status == 'Aktif' ? 'bg-green-100 text-green-700' :
                        ($row->status == 'Selesai' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                            {{ $row->status }}
                                        </span>
                                    </td>
                                    <td class="p-3 text-xs text-gray-500">{{ $row->no_kerja_sama }}</td>
                                    <td class="p-3 max-w-[200px] truncate" title="{{ $row->tentang }}">{{ $row->tentang }}</td>
                                    <td class="p-3 whitespace-nowrap">{{ $row->tgl_mulai }}</td>
                                    <td class="p-3 whitespace-nowrap">{{ $row->tgl_akhir }}</td>

                                    {{-- DOKUMEN SCAN --}}
                                    <td class="p-3">
                                        @if ($row->dok_scan)
                                            <a href="{{ asset('storage/' . $row->dok_scan) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                                <i class="fa-solid fa-file-pdf"></i>
                                                <span>Lihat</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    {{-- DOKUMEN FISIK --}}
                                    <td class="p-3">
                                        @if ($row->dok_fisik)
                                            <a href="{{ asset('storage/' . $row->dok_fisik) }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                                <i class="fa-solid fa-file-pdf"></i>
                                                <span>Lihat</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <td class="p-3 max-w-[150px] truncate" title="{{ $row->ket }}">{{ $row->ket }}</td>
                                    <td class="p-3 max-w-[150px] truncate" title="{{ $row->implementasi_evaluasi }}">
                                        {{ $row->implementasi_evaluasi }}
                                    </td>

                                    <td
                                        class="p-3 sticky right-0 bg-white group-hover:bg-gray-50 transition-colors border-l shadow-sm z-10 w-[100px]">
                                        <div class="flex items-center justify-center space-x-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('kerjasama.edit', $row->id) }}"
                                                class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition-colors"
                                                title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form id="delete-form-{{ $row->id }}" action="{{ route('kerjasama.destroy', $row->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('delete-form-{{ $row->id }}')"
                                                    class="text-red-500 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-colors cursor-pointer"
                                                    title="Hapus">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $data->links() }}
        </div>

    </div>
@endsection
@extends('layouts.app')

@section('title', 'Pegawai')
@section('page-title', 'Daftar Pegawai')

@section('content')
    <div class="p-6 w-full">

        {{-- HEADER + BUTTON --}}
        <div class="flex justify-between items-center mb-6 w-full">

            <h2 class="text-xl font-semibold">Data Pegawai</h2>

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
                        <a href="{{ route('pegawai.exportPdf') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Export PDF
                        </a>

                        {{-- Import Excel --}}
                        <form action="{{ route('pegawai.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="block px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">
                                Import Excel
                                <input type="file" name="file" class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>
                    </div>
                </div>

                {{-- TAMBAH PEGAWAI --}}
                <a href="{{ route('pegawai.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    + Tambah Pegawai
                </a>

            </div>
        </div>

        {{-- TABEL DATA PEGAWAI --}}
        <div class="bg-white shadow rounded-xl w-full overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 border-b">
                    <tr class="text-left text-sm font-semibold text-gray-700">
                        <th class="p-3">NO</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Jenis Kelamin</th>
                        <th class="p-3">Tempat / Tgl Lahir</th>
                        <th class="p-3">Pendidikan</th>
                        <th class="p-3">Pangkat/Gol</th>
                        <th class="p-3">Jabatan</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pegawai as $p)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3 font-medium text-gray-800">{{ $p->name }}</td>
                            <td class="p-3">{{ $p->gender }}</td>
                            <td class="p-3">
                                {{ $p->birth_place }},
                                {{ \Carbon\Carbon::parse($p->birth_date)->format('d/m/Y') }}
                            </td>
                            <td class="p-3">{{ $p->education }}</td>
                            <td class="p-3">{{ $p->rank }}</td>
                            <td class="p-3">{{ $p->position }}</td>

                            <td class="p-3">
                                <div class="flex items-center justify-center space-x-4">
                                    {{-- Edit --}}
                                    <a href="{{ route('pegawai.edit', $p->id) }}"
                                        class="text-blue-600 hover:text-blue-800 transition-colors" title="Edit">
                                        <i class="fa-solid fa-pen-to-square text-lg"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form id="delete-form-{{ $p->id }}" action="{{ route('pegawai.destroy', $p->id) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('delete-form-{{ $p->id }}')"
                                            class="text-red-500 hover:text-red-700 transition-colors bg-transparent border-0 p-0 cursor-pointer"
                                            title="Hapus">
                                            <i class="fa-solid fa-trash-can text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-5 text-gray-600">
                                Tidak ada data pegawai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $pegawai->links() }}
        </div>

    </div>
@endsection
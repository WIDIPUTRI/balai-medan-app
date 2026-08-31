@extends('layouts.app')

@section('title', 'Edit Pegawai')
@section('page-title', 'Edit Pegawai')

@section('content')

    <div class="max-w-4xl mx-auto bg-white shadow rounded-lg overflow-visible">

        <!-- HEADER -->
        <div class="bg-indigo-600 text-white px-6 py-4 text-lg font-semibold">
            Edit Data Pegawai
        </div>

        <form action="{{ route('pegawai.update', $data->id) }}" method="POST" enctype="multipart/form-data"
            class="p-6 space-y-6">
            @csrf
            @method('POST')

            {{-- GRID 2 KOLOM --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- NAMA --}}
                <div>
                    <label class="block text-gray-700 font-medium">Nama</label>
                    <input type="text" name="name" value="{{ $data->name }}"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- JENIS KELAMIN --}}
                <div>
                    <label class="block text-gray-700 font-medium">Jenis Kelamin</label>
                    <select name="gender" class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500"
                        required>
                        <option value="Laki-laki" {{ $data->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $data->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- TEMPAT LAHIR --}}
                <div>
                    <label class="block text-gray-700 font-medium">Tempat Lahir</label>
                    <input type="text" name="birth_place" value="{{ $data->birth_place }}"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- TANGGAL LAHIR --}}
                <div>
                    <label class="block text-gray-700 font-medium">Tanggal Lahir</label>
                    <input type="date" name="birth_date" value="{{ $data->birth_date }}"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- PENDIDIKAN --}}
                <div>
                    <label class="block text-gray-700 font-medium">Pendidikan</label>
                    <input type="text" name="education" value="{{ $data->education }}"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- PANGKAT / GOL --}}
                <div>
                    <label class="block text-gray-700 font-medium">Pangkat / Golongan</label>
                    <input type="text" name="rank" value="{{ $data->rank }}"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- JABATAN --}}
                <div>
                    <label class="block text-gray-700 font-medium">Jabatan</label>
                    <input type="text" name="position" value="{{ $data->position }}"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500" required>
                </div>

                {{-- FOTO --}}
                <div>
                    <label class="block text-gray-700 font-medium">Foto</label>
                    <input type="file" name="photo"
                        class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">
                    @if($data->photo)
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 mb-2">Foto saat ini:</p>
                            @if(Str::startsWith($data->photo, 'data:image'))
                                <img src="{{ $data->photo }}" class="w-32 h-32 object-cover rounded shadow">
                            @else
                                <img src="{{ asset($data->photo) }}" class="w-32 h-32 object-cover rounded shadow">
                            @endif
                        </div>
                    @endif
                </div>

            </div>

            <!-- TOMBOL -->
            <div class="col-span-2 flex justify-end gap-4 mt-6 pb-4">

                <a href="{{ route('pegawai.index') }}" class="px-6 py-2 border rounded-lg bg-gray-100 hover:bg-gray-200">
                    Batal
                </a>

                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update
                </button>

            </div>

        </form>
    </div>

@endsection
@extends('layouts.app')

@section('title', 'Daftar Pegawai')
@section('page-title', 'Daftar Pegawai')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Daftar Pegawai</h2>
                <p class="text-sm text-gray-600 mt-1">Kelola data pegawai sistem</p>
            </div>
            <a href="{{ route('admins.create') }}"
                class="inline-flex items-center px-4 py-2 bg-primary hover-bg-primary-dark text-white rounded-lg transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pegawai
            </a>
        </div>

        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">

                    <button type="submit"
                        class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-200">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Tempat Tanggal Lahir
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Pendidikan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Pangkat Gol./Ruang
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">No. Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase">Email</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($admins as $admin)
                            <tr class="table-row">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($admin->photo)
                                            <img src="{{ asset('storage/' . $admin->photo) }}" alt="{{ $admin->name }}"
                                                class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold">
                                                {{ substr($admin->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div class="ml-3">
                                            <span class="text-sm font-medium text-gray-900">{{ $admin->name }}</span>
                                            <p class="text-xs text-gray-500">Admin</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $admin->gender ? ucfirst($admin->gender) : '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $admin->birth_place ? $admin->birth_place : '-' }}{{ $admin->birth_date ? ', ' . $admin->birth_date->format('d/m/Y') : '' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $admin->education ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $admin->address ? \Illuminate\Support\Str::limit($admin->address, 30) : '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $admin->phone ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $admin->email }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admins.edit', $admin) }}" class="text-blue-600 hover:text-blue-700"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($admin->id != auth()->id())
                                            <form id="delete-form-{{ $admin->id }}" action="{{ route('admins.destroy', $admin) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('delete-form-{{ $admin->id }}')"
                                                    class="text-red-600 hover:text-red-700" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-500">Tidak ada data pegawai</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($admins->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $admins->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
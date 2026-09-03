@extends('layouts.app')

@section('title', 'Kenaikan Pangkat Pegawai')
@section('page-title', 'Tabel Kenaikan Pangkat (KP)')

@section('content')
    <div class="p-6 w-full">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6 w-full">
            <h2 class="text-xl font-semibold">Data Kenaikan Pangkat (KP) Pegawai</h2>
        </div>

        {{-- TABEL DATA PEGAWAI --}}
        <div class="bg-white shadow rounded-xl w-full overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 border-b">
                    <tr class="text-left text-sm font-semibold text-gray-700">
                        <th class="p-3">NO</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Tanggal SK KP</th>
                        <th class="p-3">TMT KP</th>
                        <th class="p-3">Prediksi KP 1 (4 Thn)</th>
                        <th class="p-3">Prediksi KP 2 (8 Thn)</th>
                        <th class="p-3">KP Selanjutnya (Keterangan)</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pegawai as $p)
                        @php
                            $selanjutnya = $p->kp_selanjutnya;

                            $badgeClass = 'bg-gray-100 text-gray-800'; // Default
                            if ($selanjutnya) {
                                $lowerCaseText = strtolower($selanjutnya);
                                if (str_contains($lowerCaseText, 'harusnya') || str_contains($lowerCaseText, 'terlewat') || str_contains($lowerCaseText, '2024')) {
                                    $badgeClass = 'bg-red-100 text-red-800';
                                } elseif (str_contains($lowerCaseText, '2026')) {
                                    $badgeClass = 'bg-orange-100 text-orange-800';
                                } elseif (str_contains($lowerCaseText, 'tertinggi') || str_contains($lowerCaseText, 'sudah berada')) {
                                    $badgeClass = 'bg-blue-100 text-blue-800';
                                } else {
                                    $badgeClass = 'bg-green-100 text-green-800';
                                }
                            }

                            // Prediksi KP = TMT + 4 Tahun
                            $prediksi1 = '-';
                            $prediksi2 = '-';
                            if ($p->kp_tmt) {
                                $tmtDate = \Carbon\Carbon::parse($p->kp_tmt);
                                $prediksiDate1 = $tmtDate->copy()->addYears(4);
                                $prediksiDate2 = $tmtDate->copy()->addYears(8);
                                $prediksi1 = $prediksiDate1->isoFormat('D MMMM Y');
                                $prediksi2 = $prediksiDate2->isoFormat('D MMMM Y');
                            }
                        @endphp
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $loop->iteration + ($pegawai->currentPage() - 1) * $pegawai->perPage() }}</td>
                            <td class="p-3 font-medium text-gray-800">{{ $p->name }}</td>
                            <td class="p-3 text-gray-600">
                                {{ $p->kp_tanggal_sk ? \Carbon\Carbon::parse($p->kp_tanggal_sk)->isoFormat('D MMMM Y') : '-' }}
                            </td>
                            <td class="p-3 text-gray-600">
                                {{ $p->kp_tmt ? \Carbon\Carbon::parse($p->kp_tmt)->isoFormat('D MMMM Y') : '-' }}
                            </td>
                            <td class="p-3 font-semibold text-gray-700">
                                {{ $prediksi1 }}
                            </td>
                            <td class="p-3 font-semibold text-gray-700">
                                {{ $prediksi2 }}
                            </td>
                            <td class="p-3">
                                @if($selanjutnya)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium {{ $badgeClass }}">
                                        {{ $selanjutnya }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-3">
                                <div class="flex items-center justify-center space-x-4">
                                    {{-- Edit --}}
                                    <a href="{{ route('pegawai.edit', $p->id) }}"
                                        class="text-blue-600 hover:text-blue-800 transition-colors" title="Edit Pegawai">
                                        <i class="fa-solid fa-pen-to-square text-lg"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-5 text-gray-600">
                                Tidak ada data pegawai yang memiliki informasi KP.
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
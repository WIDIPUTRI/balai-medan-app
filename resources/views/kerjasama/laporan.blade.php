@extends('layouts.app')

@section('page-title', 'Laporan Kerja Sama')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">📊 Laporan Kerja Sama</h2>

    {{-- CHART CONTAINER --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Jenis Kerja Sama --}}
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="font-semibold text-gray-700 mb-3">Jenis Kerja Sama</h3>
            <canvas id="chartJenis"></canvas>
        </div>

        {{-- Status Kerja Sama --}}
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="font-semibold text-gray-700 mb-3">Status Kerja Sama</h3>
            <canvas id="chartStatus"></canvas>
        </div>

        {{-- Kategori Mitra --}}
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="font-semibold text-gray-700 mb-3">Kategori Mitra</h3>
            <canvas id="chartMitra"></canvas>
        </div>

        {{-- Kerja Sama Akan Berakhir --}}
        <div class="bg-white shadow rounded-xl p-4">
            <h3 class="font-semibold text-gray-700 mb-3">Kerja Sama Akan Berakhir (≤ 90 Hari)</h3>
            <canvas id="chartAkanBerakhir"></canvas>
        </div>

    </div>

    {{-- TABEL KERJA SAMA AKAN BERAKHIR --}}
    <div class="bg-white shadow rounded-xl p-4 mt-6">
        <h3 class="font-semibold text-gray-800 mb-3">Detail Kerja Sama Akan Berakhir</h3>

        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Jenis KS</th>
                    <th class="p-2">Mitra</th>
                    <th class="p-2">Tgl Akhir</th>
                    <th class="p-2">Sisa Hari</th>
                </tr>
            </thead>
            <tbody>
                @foreach($akanBerakhir as $row)
                <tr class="border-b">
                    <td class="p-2">{{ $row->jenis_kerja_sama }}</td>
                    <td class="p-2">{{ $row->mitra }}</td>
                    <td class="p-2">{{ $row->tgl_akhir }}</td>
                    <td class="p-2 text-red-600">
                        {{ \Carbon\Carbon::parse($row->tgl_akhir)->diffInDays(now()) }} hari
                    </td>
                </tr>
                @endforeach

                @if ($akanBerakhir->isEmpty())
                <tr>
                    <td colspan="4" class="text-center p-3 text-gray-500">Tidak ada kerja sama yang akan berakhir</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data PHP → JS
    const jenisLabel = {!! json_encode($jenis->keys()) !!};
    const jenisData  = {!! json_encode($jenis->values()) !!};

    const statusLabel = {!! json_encode($status->keys()) !!};
    const statusData  = {!! json_encode($status->values()) !!};

    const mitraLabel = {!! json_encode($mitra->keys()) !!};
    const mitraData  = {!! json_encode($mitra->values()) !!};

    const akanBerakhirLabel = {!! json_encode($akanBerakhir->pluck('mitra')) !!};
    const akanBerakhirData  = {!! json_encode($akanBerakhir->map(fn($x)=> \Carbon\Carbon::parse($x->tgl_akhir)->diffInDays(now()))) !!};

    // ---------- Chart Jenis ----------
    new Chart(document.getElementById('chartJenis'), {
        type: 'pie',
        data: {
            labels: jenisLabel,
            datasets: [{
                data: jenisData,
                backgroundColor: ['#4e79a7','#f28e2b','#e15759','#76b7b2','#59a14f']
            }]
        }
    });

    // ---------- Chart Status ----------
    new Chart(document.getElementById('chartStatus'), {
        type: 'bar',
        data: {
            labels: statusLabel,
            datasets: [{
                label: 'Jumlah',
                data: statusData,
                backgroundColor: '#4e79a7'
            }]
        }
    });

    // ---------- Chart Mitra ----------
    new Chart(document.getElementById('chartMitra'), {
        type: 'doughnut',
        data: {
            labels: mitraLabel,
            datasets: [{
                data: mitraData,
                backgroundColor: ['#59a14f','#f28e2b','#e15759','#76b7b2']
            }]
        }
    });

    // ---------- Chart Akan Berakhir ----------
    new Chart(document.getElementById('chartAkanBerakhir'), {
        type: 'bar',
        data: {
            labels: akanBerakhirLabel,
            datasets: [{
                label: 'Sisa Hari',
                data: akanBerakhirData,
                backgroundColor: '#e15759'
            }]
        }
    });
</script>

@endsection

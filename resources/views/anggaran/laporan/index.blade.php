@extends('layouts.app')

@section('title', 'Laporan Anggaran')
@section('page-title', 'Laporan Anggaran Bulanan')

@section('content')
<div class="flex justify-between mb-4">
    <form method="GET" class="flex gap-2 items-center">
        <select name="month" class="border rounded p-2">
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
            @endforeach
        </select>
        <select name="year" class="border rounded p-2">
            @foreach(range(now()->year - 2, now()->year + 1) as $y)
                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
        <button class="bg-blue-600 text-white px-3 py-2 rounded">Tampilkan</button>
    </form>

    <div class="space-x-2">
        <a href="{{ route('laporan-anggaran.exportPdf', ['month'=>$month,'year'=>$year]) }}" class="bg-red-600 text-white px-3 py-2 rounded">Export PDF</a>
        <a href="{{ route('laporan-anggaran.exportExcel', ['month'=>$month,'year'=>$year]) }}" class="bg-green-600 text-white px-3 py-2 rounded">Export Excel</a>
    </div>
</div>

<table class="w-full border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th>Kode</th>
            <th>Nama Akun</th>
            <th>Pagu</th>
            <th>Realisasi</th>
            <th>Bulan Ini</th>
            <th>Sisa</th>
            <th>% Realisasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan as $r)
        <tr class="border-t">
            <td class="p-2">{{ $r['kode'] }}</td>
            <td class="p-2">{{ $r['nama'] }}</td>
            <td class="p-2 text-right">{{ number_format($r['pagu'],0,',','.') }}</td>
            <td class="p-2 text-right">{{ number_format($r['realisasi'],0,',','.') }}</td>
            <td class="p-2 text-right">{{ number_format($r['bulan_ini'],0,',','.') }}</td>
            <td class="p-2 text-right">{{ number_format($r['sisa'],0,',','.') }}</td>
            <td class="p-2 text-center">{{ $r['persentase'] }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

<canvas id="chart" class="mt-6"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($laporan->pluck('nama')) !!},
        datasets: [{
            label: 'Realisasi (%)',
            data: {!! json_encode($laporan->pluck('persentase')) !!},
        }]
    },
    options: {
        plugins: { legend: { display: false }},
        scales: { y: { beginAtZero: true, max: 100 } }
    }
});
</script>
@endsection

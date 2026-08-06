@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Top Widgets -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Pegawai</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalEmployees) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-xl text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Laki-laki</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($gender['L'] ?? 0) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-mars text-xl text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Perempuan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($gender['P'] ?? 0) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-venus text-xl text-pink-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Pendidikan S1/S2/S3</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ number_format(($education['S1'] ?? 0) + ($education['S2'] ?? 0) + ($education['S3'] ?? 0)) }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-xl text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Distribusi Pendidikan</h3>
                <div style="height: 300px;">
                    <canvas id="educationChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Distribusi Umur</h3>
                <div style="height: 300px;">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Employees & Gender Distribution -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Pegawai Terbaru</h3>
                    <a href="{{ route('pegawai.index') }}" class="text-sm text-primary hover:underline">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left text-xs font-medium text-gray-600 pb-3">Nama</th>
                                <th class="text-left text-xs font-medium text-gray-600 pb-3">Jabatan</th>
                                <th class="text-left text-xs font-medium text-gray-600 pb-3">Pendidikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentEmployees as $employee)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="py-3 text-sm text-gray-900 font-medium">{{ $employee->name }}</td>
                                    <td class="py-3 text-sm text-gray-600">{{ $employee->position }}</td>
                                    <td class="py-3 text-sm text-gray-600">{{ $employee->education }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-center text-sm text-gray-500">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Gender</h3>
                <div style="height: 250px;">
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="mt-6 space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-600">
                            <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                            Laki-laki
                        </span>
                        <span class="font-medium text-gray-900">{{ number_format($gender['L'] ?? 0) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-600">
                            <span class="w-3 h-3 bg-pink-500 rounded-full mr-2"></span>
                            Perempuan
                        </span>
                        <span class="font-medium text-gray-900">{{ number_format($gender['P'] ?? 0) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script>
            Chart.register(ChartDataLabels);
            Chart.defaults.set('plugins.datalabels', {
                anchor: 'end',
                align: 'end',
                color: '#374151',
                font: { weight: 'bold' },
                formatter: (value) => value
            });

            // Education Chart
            new Chart(document.getElementById('educationChart'), {
                type: 'bar',
                data: {
                    labels: @json($education->keys()),
                    datasets: [{
                        data: @json($education->values()),
                        backgroundColor: '#4F46E5',
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Age Chart
            new Chart(document.getElementById('ageChart'), {
                type: 'bar',
                data: {
                    labels: @json(array_keys($ageGroups)),
                    datasets: [{
                        data: @json(array_values($ageGroups)),
                        backgroundColor: '#F59E0B',
                        borderRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Gender Chart
            new Chart(document.getElementById('genderChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $gender['L'] ?? 0 }}, {{ $gender['P'] ?? 0 }}],
                        backgroundColor: ['#3B82F6', '#EC4899'],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => { sum += data; });
                                let percentage = (value * 100 / sum).toFixed(1) + "%";
                                return percentage;
                            },
                            color: '#fff',
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
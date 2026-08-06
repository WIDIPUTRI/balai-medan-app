@extends('layouts.app')

@section('title', 'Pegawai')
@section('page-title', 'Daftar Pegawai')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Grafik Pegawai</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Grafik Gender -->
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-3">Grafik Berdasarkan Gender</h2>
                <canvas id="genderChart"></canvas>
            </div>

            <!-- Grafik Pendidikan -->
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-3">Grafik Berdasarkan Pendidikan</h2>
                <canvas id="educationChart"></canvas>
            </div>

            <!-- Grafik Umur -->
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-3">Grafik Berdasarkan Umur</h2>
                <canvas id="ageChart"></canvas>
            </div>

            <!-- Grafik Pangkat -->
            <div class="bg-white p-4 shadow rounded-lg">
                <h2 class="text-lg font-semibold mb-3">Grafik Berdasarkan Pangkat</h2>
                <canvas id="rankChart"></canvas>
            </div>

            <!-- Grafik Jabatan (Full Width) -->
            <div class="bg-white p-4 shadow rounded-lg lg:col-span-2">
                <h2 class="text-lg font-semibold mb-3">Grafik Berdasarkan Jabatan</h2>
                <div style="height: 600px; position: relative;">
                    <canvas id="jabatanChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        // Global Chart Defaults
        Chart.register(ChartDataLabels);
        Chart.defaults.set('plugins.datalabels', {
            anchor: 'end',
            align: 'end',
            color: '#374151',
            font: {
                weight: 'bold',
                size: 11
            },
            formatter: (value) => value
        });

        // Gender Chart
        new Chart(document.getElementById('genderChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($gender->keys()) !!},
                datasets: [{
                    data: {!! json_encode($gender->values()) !!},
                    backgroundColor: ['#3b82f6', '#ec4899', '#10b981']
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            dataArr.map(data => { sum += data; });
                            let percentage = (value*100 / sum).toFixed(1)+"%";
                            return value + ' (' + percentage + ')';
                        },
                        color: '#fff',
                    }
                }
            }
        });

        // Education Chart
        new Chart(document.getElementById('educationChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($education->keys()) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($education->values()) !!},
                    backgroundColor: '#6366f1'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });

        // Age Group Chart
        new Chart(document.getElementById('ageChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($ageGroups)) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode(array_values($ageGroups)) !!},
                    backgroundColor: '#f59e0b'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });

        // Rank Chart (Pangkat)
        new Chart(document.getElementById('rankChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($rank->keys()) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($rank->values()) !!},
                    backgroundColor: '#0ea5e9'
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });

        // Jabatan Chart
        new Chart(document.getElementById('jabatanChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($jabatan->keys()) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode($jabatan->values()) !!},
                    backgroundColor: '#10b981'
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    datalabels: {
                        anchor: 'end',
                        align: 'right',
                        offset: 5
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { display: false },
                        ticks: { display: false } // Hide X ticks as we have datalabels
                    },
                    y: {
                        ticks: {
                            autoSkip: false,
                            font: { size: 11 }
                        }
                    }
                },
                layout: {
                    padding: { right: 50 }
                }
            }
        });
    </script>
@endsection

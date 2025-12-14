@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-5 space-y-8">

        {{-- TITLE --}}
        <div class="title">
            <div class="text-4xl font-extrabold flex items-center gap-3 text-white pb-4 tracking-wide drop-shadow-lg">
                <span class="bg-gradient-to-r from-blue-300 to-green-300 bg-clip-text text-transparent">
                    Dashboard
                </span>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="bg-gradient-to-r from-green-500 via-emerald-500 to-blue-600 shadow-2xl rounded-2xl p-10 text-center text-white 
                    transition-transform transform hover:scale-105 hover:shadow-[0_0_30px_rgba(0,0,0,0.35)] duration-300">
            <h1 class="text-4xl font-extrabold mb-3 drop-shadow-md">
                Welcome to Sistem Peternakan Karsa Farm
            </h1>
            <p class="text-lg opacity-90 tracking-wide">
                Manage your farm efficiently and smartly
            </p>
        </div>

        <!-- Statistik Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Total Ternak -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white rounded-2xl shadow-xl p-6 
                        flex items-center gap-5 transition-all hover:scale-105 hover:shadow-2xl duration-300">
                <div class="p-5 bg-white/20 rounded-2xl backdrop-blur-sm shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <div class="text-4xl font-extrabold drop-shadow-sm">{{ $jumlahTernak ?? 0 }}</div>
                    <div class="text-sm uppercase tracking-wider opacity-90">Total Ternak</div>
                </div>
            </div>

            <!-- Total Kandang -->
            <div class="bg-gradient-to-br from-green-600 to-teal-700 text-white rounded-2xl shadow-xl p-6 
                        flex items-center gap-5 transition-all hover:scale-105 hover:shadow-2xl duration-300">
                <div class="p-5 bg-white/20 rounded-2xl backdrop-blur-sm shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h16V10" />
                    </svg>
                </div>
                <div>
                    <div class="text-4xl font-extrabold drop-shadow-sm">{{ $jumlahKandang ?? 0 }}</div>
                    <div class="text-sm uppercase tracking-wider opacity-90">Total Kandang</div>
                </div>
            </div>

            <!-- Total Aktivitas -->
            <div class="bg-gradient-to-br from-yellow-500 to-orange-600 text-white rounded-2xl shadow-xl p-6 
                        flex items-center gap-5 transition-all hover:scale-105 hover:shadow-2xl duration-300">
                <div class="p-5 bg-white/20 rounded-2xl backdrop-blur-sm shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-4xl font-extrabold drop-shadow-sm">{{ $jumlahAktivitas ?? 0 }}</div>
                    <div class="text-sm uppercase tracking-wider opacity-90">Total Aktivitas</div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    const ctx = document.getElementById('kategoriChart').getContext('2d');
    let kategoriChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($kategoriLabels ?? []),
            datasets: [{
                label: 'Jumlah Ternak',
                data: @json($kategoriCounts ?? []),
                backgroundColor: function(context) {
                    const colors = [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ];
                    return colors[context.dataIndex % colors.length];
                },
                borderColor: '#fff',
                borderWidth: 2,
                borderRadius: 10,
                hoverBackgroundColor: 'rgba(0,0,0,0.25)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: { size: 15, weight: 'bold' }
                    }
                },
                tooltip: {
                    backgroundColor: '#222',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#000',
                    borderWidth: 1
                }
            },
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            },
            scales: {
                y: { beginAtZero: true },
                x: { }
            }
        }
    });

    $('#kategoriSelect').on('change', function() {
        let kategori = $(this).val();
        $.post("{{ route('dashboard.filter') }}", {
            _token: "{{ csrf_token() }}",
            kategori: kategori
        }, function(res) {
            kategoriChart.data.labels = res.labels;
            kategoriChart.data.datasets[0].data = res.data;
            kategoriChart.update();
        });
    });
</script>
@endsection

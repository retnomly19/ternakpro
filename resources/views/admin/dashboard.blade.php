@extends('layouts.app_admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Total User -->
    <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
        <div class="p-4 bg-blue-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor">
                <circle cx="12" cy="7" r="4"/>
                <path d="M5.5 21a7.5 7.5 0 0113 0"/>
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Total User Login</p>
            <h2 class="text-2xl font-bold">{{ $totalUsers }}</h2>
        </div>
    </div>

    <!-- User Hari Ini -->
    <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
        <div class="p-4 bg-green-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" stroke="currentColor">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </div>
        <div>
            <p class="text-gray-500 text-sm">User Login Hari Ini</p>
            <h2 class="text-2xl font-bold">{{ $todayUsers }}</h2>
        </div>
    </div>
</div>

<!-- Grafik Login Harian -->
<div class="mt-8 bg-white shadow rounded-xl p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Grafik Login Harian</h3>
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor">
            <path d="M3 3v18h18"/>
            <path d="M9 14l3-3 4 4"/>
        </svg>
    </div>
    <canvas id="loginChart" class="w-full max-h-64"></canvas>
</div>
@endsection

@section('scripts')
<!-- Chart.js CDN WAJIB -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('loginChart');
    if (!canvas) {
        console.warn('Canvas #loginChart tidak ditemukan.');
        return;
    }

    const ctx = canvas.getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'User Login',
                data: @json($logins),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37,99,235,0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#2563eb',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.parsed.y} login`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});
</script>
@endsection

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TernakPro - Manajemen Peternakan</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="relative bg-white min-h-screen text-slate-900 dark:bg-slate-900 dark:text-slate-100">

    <!-- Background image (place your farm image at public/images/farm-bg.jpg) -->
    <div class="absolute inset-0 bg-center bg-cover pointer-events-none" style="background-image: url('/images/download[1].jpg'); filter: saturate(.95) contrast(.95);"></div>
    <!-- Readability overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-white/70 via-white/60 to-sky-50/60 dark:from-slate-900/70 dark:via-slate-900/60 dark:to-slate-800/60"></div>

    <header class="relative z-10 max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
        <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-3">
            <!-- Simple farm SVG -->
            <svg viewBox="0 0 24 24" class="w-10 h-10 text-amber-500" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden>
                <path d="M12 2L2 7v7a3 3 0 003 3h3v-4h6v4h3a3 3 0 003-3V7L12 2z" fill="currentColor" />
                <path d="M7 14v3" stroke="#fff" stroke-width="0.5" stroke-linecap="round" />
            </svg>
            <span class="font-semibold text-xl">TernakPro</span>
        </a>

        <?php if(Route::has('login')): ?>
            <nav class="flex items-center gap-3">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="px-4 py-2 rounded bg-amber-500 text-white">Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="px-4 py-2 rounded text-sky-700 border border-sky-200 bg-white/70 hover:bg-white">Log in</a>
                    <?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="px-4 py-2 rounded bg-sky-600 text-white hover:bg-sky-700">Register</a>
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
        <?php endif; ?>
    </header>

    <main class="relative z-10">
        <!-- Hero (HD) -->
        <div class="max-w-7xl mx-auto px-6 py-20 lg:py-32">
            <div class="mx-auto max-w-4xl text-center">
                <h1 class="text-5xl sm:text-6xl font-extrabold text-sky-900 dark:text-sky-200 leading-tight drop-shadow-sm">Solusi Manajemen Peternakan Modern</h1>
                <p class="mt-6 text-lg text-slate-700 dark:text-slate-300 max-w-2xl mx-auto">Kelola ternak, kandang, kesehatan, dan penjualan dalam satu platform sederhana dan terpercaya. Dirancang untuk efisiensi, visibilitas, dan kontrol penuh atas operasi peternakan Anda.</p>

                <div class="mt-10 flex justify-center gap-4">
                    <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center gap-3 px-8 py-4 bg-sky-600 hover:bg-sky-700 text-white rounded-full text-lg shadow-xl transition">Mulai Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="#fitur" class="inline-flex items-center gap-3 px-6 py-4 border border-sky-600 text-sky-600 rounded-full bg-white/80 hover:bg-white transition">Pelajari Lebih Lanjut</a>
                </div>

                <!-- Glass feature cards -->
                <div class="mt-14 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-6 bg-white/95 dark:bg-slate-800/80 rounded-2xl shadow-lg backdrop-blur-sm border border-white/60">
                        <svg class="w-8 h-8 text-sky-600 mb-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h3V7a1 1 0 011-1h2V3h2v3h2a1 1 0 011 1v3h3a1 1 0 011 1v2a1 1 0 01-1 1h-3v3a1 1 0 01-1 1H8a1 1 0 01-1-1v-3H4a1 1 0 01-1-1v-2z"/></svg>
                        <h4 class="font-semibold text-sky-800 dark:text-sky-300">Pemantauan Kesehatan</h4>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Catat vaksin, pengobatan, dan riwayat kesehatan per ternak dengan cepat.</p>
                    </div>
                    <div class="p-6 bg-white/95 dark:bg-slate-800/80 rounded-2xl shadow-lg backdrop-blur-sm border border-white/60">
                        <svg class="w-8 h-8 text-sky-600 mb-3" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3h14v2H3V3zm0 4h14v10H3V7z"/></svg>
                        <h4 class="font-semibold text-sky-800 dark:text-sky-300">Manajemen Kandang</h4>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Atur lokasi, kapasitas, dan kelompok ternak secara intuitif.</p>
                    </div>
                    <div class="p-6 bg-white/95 dark:bg-slate-800/80 rounded-2xl shadow-lg backdrop-blur-sm border border-white/60">
                        <svg class="w-8 h-8 text-sky-600 mb-3" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3h12v2H4V3zm0 4h8v10H4V7z"/></svg>
                        <h4 class="font-semibold text-sky-800 dark:text-sky-300">Penjualan & Laporan</h4>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">Kelola transaksi, pelanggan, dan laporan penjualan dalam satu tempat.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fitur (detail) -->
        <section id="fitur" class="max-w-7xl mx-auto px-6 pb-20">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="p-6 bg-white/95 dark:bg-slate-800/80 rounded-lg shadow">
                    <h3 class="font-semibold mb-2 text-sky-700 dark:text-sky-300">Dashboard & Statistik</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Ringkasan performa ternak, stok pakan, dan laporan harian.</p>
                </div>
                <div class="p-6 bg-white/95 dark:bg-slate-800/80 rounded-lg shadow">
                    <h3 class="font-semibold mb-2 text-sky-700 dark:text-sky-300">Manajemen Ternak</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Data individual ternak, umur, jenis, dan riwayat aktivitas.</p>
                </div>
                <div class="p-6 bg-white/95 dark:bg-slate-800/80 rounded-lg shadow">
                    <h3 class="font-semibold mb-2 text-sky-700 dark:text-sky-300">Integrasi & Keamanan</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Hak akses multi-user, backup data, dan integrasi ekspor.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="w-full border-t py-6 mt-12">
        <div class="relative z-10 max-w-6xl mx-auto px-6 text-center text-sm text-slate-600 dark:text-slate-400">
            &copy; <?php echo e(date('Y')); ?> TernakPro. All rights reserved.
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\laragon\www\ternakpro2\resources\views/landing.blade.php ENDPATH**/ ?>
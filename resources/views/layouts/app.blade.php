<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>[x-cloak] { display: none !important; }</style>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        .farm-bg { background: linear-gradient(135deg, #eff6ff, #dbeafe, #bfdbfe); }
        aside { position: fixed; top: 0; left: 0; height: 100%; overflow-y: auto; }
        .main-content { margin-left: 16rem; }
        header { position: sticky; top: 0; z-index: 50; }
    </style>
</head>

<body class="bg-blue-50 font-sans antialiased">
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white shadow-lg flex flex-col">
        <div class="p-6 text-center border-b border-blue-500">
            <h1 class="text-2xl font-extrabold tracking-wider text-yellow-300">KARSA FARM</h1>
            <p class="text-sm text-blue-200 mt-1">Manajemen Ternak Terintegrasi</p>
        </div>
        <nav class="flex-1 px-3 py-4">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" title="Lihat ringkasan sistem"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              {{ request()->routeIs('dashboard') ? 'bg-blue-800 font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-12l2 2m-2-2v12H5V5l2-2" />
                        </svg>
                        Dashboard
                    </a>
                </li>

                <!-- Data Ternak -->
                <li>
                    <a href="{{ route('ternak.index') }}" title="Kelola data semua ternak"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              {{ request()->routeIs('ternak.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                        Data Ternak
                    </a>
                </li>

                <!-- Aktivitas -->
                <li>
                    <a href="{{ route('aktivitas.index') }}" title="Pantau aktivitas harian ternak"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              {{ request()->routeIs('aktivitas.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10m-9 4h6m-9 4h12m2-12H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V7a2 2 0 00-2-2z" />
                        </svg>
                        Aktivitas
                    </a>
                </li>

                <!-- Jenis Aktivitas -->
                <li>
                    <a href="{{ route('jenis_aktivitas.index') }}" title="Kelola jenis aktivitas ternak"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              {{ request()->routeIs('jenis_aktivitas.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Jenis Aktivitas
                    </a>
                </li>

                <!-- Data Kandang -->
                <li>
                    <a href="{{ route('kandang.index') }}" title="Data kandang dan lokasi"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              {{ request()->routeIs('kandang.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 9.75L12 3l9 6.75V21a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 21V9.75z" />
                        </svg>
                        Data Kandang
                    </a>
                </li>

                <!-- Kategori Ternak -->
                <li>
                    <a href="{{ route('kategori_ternak.index') }}" title="Kategori hewan ternak"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              {{ request()->routeIs('kategori_ternak.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Kategori Ternak
                    </a>
                </li>

                <!-- Penjualan Ternak -->
                <li>
                    <a href="{{ route('penjualan_ternak.index') }}" title="Data transaksi penjualan ternak"
                       class="flex items-center gap-3 py-2 px-3 rounded-lg hover:bg-blue-600 transition
                              {{ request()->routeIs('penjualan.*') ? 'bg-blue-800 font-semibold' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.105 0-2 .672-2 1.5S10.895 11 12 11s2 .672 2 1.5S13.105 14 12 14s-2 .672-2 1.5S10.895 17 12 17m0-13C7.03 4 3 8.03 3 13s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9z" />
                        </svg>
                        Penjualan Ternak
                    </a>
                </li>

                <!-- Laporan -->
                <li x-data="{ open: {{ request()->routeIs('laporan.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" title="Laporan data"
                        class="flex items-center justify-between w-full py-2 px-3 rounded-lg hover:bg-blue-600 transition">
                        <span class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V5a2 2 0 012-2h6l6 6v10a2 2 0 01-2 2z" />
                            </svg>
                            Laporan
                        </span>
                        <svg :class="{'rotate-90': open}" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="mt-1 pl-6 space-y-1 text-blue-100">
                        <li><a href="{{ route('laporan.aktivitas') }}" title="Laporan aktivitas" class="block px-2 py-1 rounded hover:bg-blue-600">Aktivitas</a></li>
                        <li><a href="{{ route('laporan.persediaan') }}" title="Laporan persediaan" class="block px-2 py-1 rounded hover:bg-blue-600">Persediaan</a></li>
                        <li><a href="{{ route('laporan.penjualan') }}" title="Laporan penjualan" class="block px-2 py-1 rounded hover:bg-blue-600">Penjualan</a></li>
                        <li><a href="{{ route('laporan.kematian') }}" title="Laporan kematian ternak" class="block px-2 py-1 rounded hover:bg-blue-600">Kematian</a></li>
                    </ul>
                </li>

                <!-- Setting -->
                <li x-data="{ open: false }">
                    <button @click="open = !open" title="Pengaturan sistem"
                        class="flex items-center justify-between w-full py-2 px-3 rounded-lg hover:bg-blue-600 transition">
                        <span class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 1.343-3 3 0 .351.06.687.171 1H9a3 3 0 100 6h6a3 3 0 000-6h-.171A3.001 3.001 0 0012 8z" />
                            </svg>
                            Setting
                        </span>
                        <svg :class="{'rotate-90': open}" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <ul x-show="open" x-transition class="mt-1 pl-6 space-y-1 text-blue-100">
                        <li><a href="{{ route('pemasok.index') }}" title="Data pemasok" class="block px-2 py-1 rounded hover:bg-blue-600">Pemasok</a></li>
                        <li><a href="{{ route('mitra.index') }}" title="Data mitra" class="block px-2 py-1 rounded hover:bg-blue-600">Mitra</a></li>
                        <li><a href="{{ route('pelanggan.index') }}" title="Data pelanggan" class="block px-2 py-1 rounded hover:bg-blue-600">Pelanggan</a></li>
                    </ul>
                </li>

                <!-- Logout -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Keluar dari aplikasi"
                                class="flex items-center gap-3 w-full py-2 px-3 rounded-lg bg-red-600 hover:bg-red-700 font-semibold transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-12v1m-6 9a9 9 0 1118 0 9 9 0 01-18 0z" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col main-content">
        <header class="bg-blue-700 px-6 py-4 text-white flex items-center shadow-md">
    <h1 class="mx-auto text-lg font-bold tracking-wide">@yield('header')</h1>
    <div class="ml-auto flex items-center space-x-3">
        <a href="{{ route('profile.index') }}" class="flex items-center gap-2 hover:opacity-90">
            @if(Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                     class="w-10 h-10 rounded-full object-cover border-2 border-white">
            @else
                <div class="w-10 h-10 rounded-full bg-yellow-300 text-blue-900 flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
            @endif
            <span class="font-medium">{{ Auth::user()->name }}</span>
        </a>
    </div>
</header>


        <main class="flex-1 p-6 overflow-auto farm-bg">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
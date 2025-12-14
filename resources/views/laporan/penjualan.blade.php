@extends('layouts.app')

@section('header')
    <h2 class="text-xl font-bold text-white"></h2>
@endsection

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Laporan Penjualan Ternak
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('laporan.penjualan') }}" class="mb-6 no-print">
        <div class="flex flex-wrap justify-center items-center gap-4">
            {{-- Bulan --}}
            <select name="bulan" class="border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                <option value="">Pilih Bulan</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endfor
            </select>

            {{-- Tahun --}}
            <select name="tahun" class="border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
                <option value="">Pilih Tahun</option>
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>

            {{-- Kandang --}}
            <select name="kandang" class="border rounded px-3 py-2 text-sm focus:ring focus:ring-blue-200">
    <option value="">Pilih Kandang</option>
    @foreach ($kandangList as $nama)
        <option value="{{ $nama }}" {{ request('kandang') == $nama ? 'selected' : '' }}>
            {{ $nama }}
        </option>
    @endforeach
</select>


            {{-- Tombol --}}
            <div class="flex gap-2">
                <button type="submit" class="flex items-center gap-1 bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M9 14h6m-6 4h6"/>
                    </svg>
                    Filter
                </button>

                <a href="{{ route('laporan.penjualan') }}" class="flex items-center gap-1 bg-gray-200 text-gray-800 px-3 py-2 rounded text-sm hover:bg-gray-300 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Reset
                </a>

                <button type="button" onclick="printDiv('printArea')" class="flex items-center gap-1 bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700 shadow">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V4h12v5M6 14h12v7H6z"/>
                    </svg>
                    Print
                </button>
            </div>
        </div>
    </form>

    {{-- Area yang diprint --}}
    <div id="printArea">
        {{-- Info Filter --}}
        @if(request('bulan') || request('tahun') || request('kandang'))
            <div class="text-center mb-6 text-gray-700 font-medium">
                <h3 class="text-lg font-bold mb-2">Laporan Penjualan Ternak</h3>
                <p>
                    @if(request('bulan'))
                        Bulan: <span class="font-semibold">{{ DateTime::createFromFormat('!m', request('bulan'))->format('F') }}</span>
                    @endif
                    @if(request('tahun'))
                        , Tahun: <span class="font-semibold">{{ request('tahun') }}</span>
                    @endif
                    @if(request('kandang'))
    <p>Kandang: <span class="font-semibold">{{ request('kandang') }}</span></p>
@else
    <p>Kandang: <span class="text-gray-500">Semua Kandang</span></p>
@endif

                </p>
            </div>
        @endif

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-gray-400 text-center font-semibold text-gray-700">
                    <tr>
                        <th class="px-3 py-2">No</th>
                        <th class="px-3 py-2">Tanggal</th>
                        <th class="px-3 py-2">ID Ternak</th>
                        <th class="px-3 py-2">Jenis Ternak</th>
                        <th class="px-3 py-2">Harga Jual</th>
                        <th class="px-3 py-2">Pelanggan</th>
                        <th class="px-3 py-2">Penanggung Jawab</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    @forelse ($data as $index => $item)
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-3 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-3 py-2">{{ $item->ternak->id_ternak ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $item->ternak->jenis ?? '-' }}</td>
                            <td class="px-3 py-2">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td class="px-3 py-2">{{ $item->id_pelanggan }} - {{ $item->pelanggan->nama ?? '-' }}</td>
                            <td class="px-3 py-2">{{ $item->ternak->penanggung_jawab ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-4 text-center text-gray-500">Tidak ada data penjualan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script Print --}}
<script>
    function printDiv(divId) {
        var content = document.getElementById(divId).innerHTML;
        var original = document.body.innerHTML;
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = original;
    }
</script>

{{-- CSS khusus print --}}
<style>
@media print {
    .no-print { display: none !important; }
    body { background: white !important; }
}
</style>
@endsection

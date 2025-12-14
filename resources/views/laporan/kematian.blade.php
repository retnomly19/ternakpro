@extends('layouts.app')

@section('header')
        
    </h2>
@endsection

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Laporan Kematian Ternak
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('laporan.kematian') }}" class="mb-6 no-print">
        <div class="flex flex-wrap justify-center items-center gap-4">
            
            {{-- Bulan --}}
            <select name="bulan" class="border rounded px-3 py-2 text-sm shadow-sm">
                <option value="">Pilih Bulan</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endfor
            </select>

            {{-- Tahun --}}
            <select name="tahun" class="border rounded px-3 py-2 text-sm shadow-sm">
                <option value="">Pilih Tahun</option>
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>

            {{-- Kandang --}}
            <select name="kandang" class="border rounded px-3 py-2 text-sm shadow-sm">
                <option value="">Pilih Kandang</option>
                @foreach ($kandangList as $id => $nama)
                    <option value="{{ $id }}" {{ request('kandang') == $id ? 'selected' : '' }}>
                        {{ $nama }}
                    </option>
                @endforeach
            </select>

            {{-- Tombol --}}
            <div class="flex gap-2">
                <button type="submit" 
                    class="flex items-center gap-1 bg-blue-600 text-white px-3 py-2 rounded text-sm hover:bg-blue-700 shadow">
                    
                    Filter
                </button>
                <a href="{{ route('laporan.kematian') }}" 
                   class="flex items-center gap-1 bg-gray-200 text-gray-800 px-3 py-2 rounded text-sm hover:bg-gray-300 shadow">
                    
                    Reset
                </a>
                <button type="button" onclick="printDiv('printArea')" 
                    class="flex items-center gap-1 bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700 shadow">
                    
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
                <h3 class="text-lg font-bold mb-2">Laporan Kematian Ternak</h3>
                <p>
                    @if(request('bulan'))
                        Bulan: <span class="font-semibold">{{ DateTime::createFromFormat('!m', request('bulan'))->format('F') }}</span>
                    @endif
                    @if(request('tahun'))
                        , Tahun: <span class="font-semibold">{{ request('tahun') }}</span>
                    @endif
                    @if(request('kandang'))
                        , Kandang: <span class="font-semibold">{{ $kandangList[request('kandang')] ?? 'Semua Kandang' }}</span>
                    @else
                        , Semua Kandang
                    @endif
                </p>
            </div>
        @endif

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border border-gray-200 rounded-lg">
                <thead class="bg-blue-100 text-gray-700 font-semibold text-center">
                    <tr>
                        <th class="px-3 py-2">No</th>
                        <th class="px-3 py-2">Tanggal Kematian</th>
                        <th class="px-3 py-2">ID Ternak</th>
                        <th class="px-3 py-2">Jenis Ternak</th>
                        <th class="px-3 py-2">Kandang</th>
                        <th class="px-3 py-2">Penanggung Jawab</th>
                        <th class="px-3 py-2">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-left">
                    @forelse ($data as $index => $row)
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-3 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-3 py-2">{{ $row['tanggal'] }}</td>
                            <td class="px-3 py-2">{{ $row['id_ternak'] }}</td>
                            <td class="px-3 py-2">{{ $row['jenis'] }}</td>
                            <td class="px-3 py-2">{{ $row['kandang'] }}</td>
                            <td class="px-3 py-2 text-center">{{ $row['penanggung_jawab'] }}</td>
                            <td class="px-3 py-2">{{ $row['keterangan'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-4 text-center text-gray-500">Tidak ada data kematian ternak ditemukan.</td>
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

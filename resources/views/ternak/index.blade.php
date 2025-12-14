@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4 max-w-7xl">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Data Ternak 
        </div>
    </div>

    <!-- Filter & Search -->
<form method="GET" action="{{ route('ternak.index') }}" 
      class="mb-4 flex flex-wrap gap-3 items-end bg-white p-3 rounded-md shadow-sm border text-sm">

    <!-- Search -->
    <div>
        <label for="search" class="block font-semibold mb-1 text-xs text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
            </svg>
            Cari
        </label>
        <input type="text" name="search" id="search" value="{{ request('search') }}"
            class="border rounded-md px-2 py-1.5 min-w-[160px] shadow-sm focus:ring focus:ring-blue-200"
            placeholder="ID / Jenis / Vaksinasi">
    </div>

    <!-- Kategori -->
    <div>
        <label for="filter_kategori" class="block font-semibold mb-1 text-xs text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
            Kategori
        </label>
        <select name="filter_kategori" id="filter_kategori" 
            class="border rounded-md px-2 py-1.5 min-w-[120px] shadow-sm focus:ring focus:ring-blue-200">
            <option value="">-- Semua --</option>
            @foreach(['Domba','Kambing','Sapi','Kerbau','Ayam','Kuda'] as $cat)
                <option value="{{ $cat }}" @selected(request('filter_kategori') == $cat)>{{ $cat }}</option>
            @endforeach
        </select>
    </div>

    <!-- Lokasi -->
    <div>
        <label for="filter_lokasi" class="block font-semibold mb-1 text-xs text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.66 0 3-1.34 3-3S13.66 5 12 5s-3 1.34-3 3 1.34 3 3 3zm0 0c-4.42 0-8 2.24-8 5v2h16v-2c0-2.76-3.58-5-8-5z" />
            </svg>
            Lokasi
        </label>
        <select name="filter_lokasi" id="filter_lokasi" 
            class="border rounded-md px-2 py-1.5 min-w-[120px] shadow-sm focus:ring focus:ring-blue-200">
            <option value="">-- Semua --</option>
            @foreach(['Kandang A','Kandang B','Kandang C','Kandang D','Kandang E','Kandang F','Kandang G','Kandang H'] as $loc)
                <option value="{{ $loc }}" @selected(request('filter_lokasi') == $loc)>{{ $loc }}</option>
            @endforeach
        </select>
    </div>

    <!-- Umur -->
    <div>
        <label for="filter_umur" class="block font-semibold mb-1 text-xs text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
            </svg>
            Umur
        </label>
        <input type="number" name="filter_umur" id="filter_umur" value="{{ request('filter_umur') }}"
            class="border rounded-md px-2 py-1.5 w-20 shadow-sm focus:ring focus:ring-blue-200"
            placeholder="bln">
    </div>

    <!-- Jenis Kelamin -->
    <div>
        <label for="filter_jenis_kelamin" class="block font-semibold mb-1 text-xs text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="12" r="3" stroke-width="2" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l6-6M9 15l-6 6" />
            </svg>
            Jenis Kelamin
        </label>
        <select name="filter_jenis_kelamin" id="filter_jenis_kelamin" 
            class="border rounded-md px-2 py-1.5 min-w-[120px] shadow-sm focus:ring focus:ring-blue-200">
            <option value="">-- Semua --</option>
            <option value="Jantan" @selected(request('filter_jenis_kelamin')=='Jantan')>Jantan</option>
            <option value="Betina" @selected(request('filter_jenis_kelamin')=='Betina')>Betina</option>
        </select>
    </div>

    <!-- Kondisi -->
    <div>
        <label for="filter_kondisi" class="block font-semibold mb-1 text-xs text-gray-700 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21C12 21 4 13.278 4 8a8 8 0 1116 0c0 5.278-8 13-8 13z" />
            </svg>
            Kondisi
        </label>
        <select name="filter_kondisi" id="filter_kondisi" 
            class="border rounded-md px-2 py-1.5 min-w-[120px] shadow-sm focus:ring focus:ring-blue-200">
            <option value="">-- Semua --</option>
            <option value="Sehat" @selected(request('filter_kondisi')=='Sehat')>Sehat</option>
            <option value="Sakit" @selected(request('filter_kondisi')=='Sakit')>Sakit</option>
        </select>
    </div>

    <!-- Tombol Filter -->
    <div>
        <button type="submit" 
            class="bg-blue-800 text-white px-3 py-1.5 rounded-md hover:bg-blue-700 transition shadow-sm flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6h10M10 12h10M10 18h10M4 6h.01M4 12h.01M4 18h.01" />
            </svg>
            Filter
        </button>
    </div>

    <!-- Tombol Reset -->
    <div>
        <a href="{{ route('ternak.index') }}" class="text-gray-500 hover:underline text-xs">Reset</a>
    </div>
</form>

<!-- Tambah Data -->
<div class="mb-4">
    <a href="{{ route('ternak.create') }}"
        class="bg-blue-800 text-white px-3 py-1.5 rounded-md hover:bg-green-700 transition text-sm shadow-sm inline-flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Data Ternak
    </a>
</div>


    <!-- Table -->
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200 table-auto text-xs">
        <thead class="bg-gray-300 text-gray-700">
            <tr>
                <th class="px-3 py-2 text-center font-semibold">No</th>
        <th class="px-3 py-2 text-center font-semibold">Foto</th>
        <th class="px-3 py-2 text-center font-semibold">ID Ternak</th>
        <th class="px-3 py-2 text-center font-semibold">Kategori</th>
        <th class="px-3 py-2 text-center font-semibold">Jenis</th>
        <th class="px-3 py-2 text-center font-semibold">Lokasi</th>
        <th class="px-3 py-2 text-center font-semibold">Umur (bln)</th>
        <th class="px-3 py-2 text-center font-semibold">Jenis Kelamin</th>
        <th class="px-3 py-2 text-center font-semibold">Harga Beli</th>
        <th class="px-3 py-2 text-center font-semibold">Kondisi</th>
        <th class="px-3 py-2 text-center font-semibold">Tanggal Masuk</th>
        <th class="px-3 py-2 text-center font-semibold">Vaksinasi</th>
        <th class="px-3 py-2 text-center font-semibold">Penanggung Jawab</th>
        <th class="px-3 py-2 text-center font-semibold">Pemasok</th>
        <th class="px-3 py-2 text-center font-semibold">Cek Medis Terakhir</th>
        <th class="px-3 py-2 text-center font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($ternak as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-2 py-1 text-center">
                        {{ $loop->iteration + ($ternak->currentPage() - 1) * $ternak->perPage() }}
                    </td>
                    <td class="px-2 py-1">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Ternak" class="w-10 h-10 object-cover rounded-md">
                        @else
                            <span class="text-gray-400">Tidak ada</span>
                        @endif
                    </td>
                    <td class="px-2 py-1">{{ $item->id_ternak }}</td>
                    <td class="px-2 py-1">{{ $item->kategori }}</td>
                    <td class="px-2 py-1">{{ $item->jenis }}</td>
                    <td class="px-2 py-1">{{ $item->lokasi }}</td>
                    <td class="px-2 py-1">{{ $item->umur }}</td>
                    <td class="px-2 py-1">{{ $item->jenis_kelamin }}</td>
                    <td class="px-2 py-1">Rp {{ number_format($item->harga_beli, 2, ',', '.') }}</td>
                    <td class="px-2 py-1">{{ $item->kondisi }}</td>
                    <td class="px-2 py-1">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                    <td class="px-2 py-1">{{ $item->vaksinasi ?? '-' }}</td>
                    <td class="px-2 py-1">{{ $item->penanggung_jawab ?? '-' }}</td>
                    <td class="px-2 py-1">{{ $item->pemasok->nama ?? '-' }}</td>
                    <td class="px-2 py-1">{{ $item->cek_medis_terakhir ? \Carbon\Carbon::parse($item->cek_medis_terakhir)->format('d/m/Y') : '-' }}</td>
                    <td class="px-2 py-1 text-center">
                        <div class="flex justify-center space-x-2">
                            <!-- Edit -->
<a href="{{ route('ternak.edit', $item->id_ternak) }}" 
   class="text-blue-600 hover:text-blue-800" title="Edit">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M15.232 5.232l3.536 3.536M4 20h4l10.293-10.293a1 1 0 00-1.414-1.414L6.586 18.586A1 1 0 006 19.293V20z" />
    </svg>
</a>

                            <!-- Hapus -->
                            <form action="{{ route('ternak.destroy', $item->id_ternak) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="16" class="px-2 py-3 text-center text-gray-500">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    <div class="mt-4">
        {{ $ternak->withQueryString()->links() }}
    </div>
</div>
@endsection

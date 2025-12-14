@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
        Data Penjualan Ternak
        </div>
    </div>

    {{-- Tombol Tambah --}}
    <div class="flex justify-start mb-4">
        <a href="{{ route('penjualan_ternak.create') }}"
           class="inline-flex items-center gap-2 bg-blue-800 text-white px-4 py-2 rounded-full shadow hover:bg-green-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Penjualan
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow-sm text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white shadow rounded-xl border border-gray-200">
        <table class="w-full text-sm">
            <thead class="bg-gray-300 text-gray-700">
                <tr>
                    <th class="border px-3 py-3 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/>
                        </svg>
                        ID
                    </th>
                    <th class="border px-3 py-3 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Tanggal
                    </th>
                    <th class="border px-3 py-3 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-2.21 0-4 .79-4 2s1.79 2 4 2 4 .79 4 2-1.79 2-4 2m0-8V4m0 16v-4"/>
                        </svg>
                        Harga Jual
                    </th>
                    <th class="border px-3 py-3 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Jenis Ternak
                    </th>
                    <th class="border px-3 py-3 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6h5V6H9v14h5z"/>
                        </svg>
                        Pelanggan
                    </th>
                    <th class="border px-3 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan as $item)
                <tr class="hover:bg-blue-50 transition">
                    <td class="border px-3 py-2 text-center text-gray-600">{{ $item->id }}</td>
                    <td class="border px-3 py-2 text-center">{{ $item->tanggal }}</td>
                    <td class="border px-3 py-2 text-center">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                    <td class="border px-3 py-2 text-center">{{ $item->ternak->id_ternak ?? '-' }} - {{ $item->ternak->jenis ?? '-' }}</td>
                    <td class="border px-3 py-2 text-center">{{ $item->pelanggan->nama ?? '-' }}</td>
                    <td class="border px-3 py-2 text-center flex justify-center gap-2">
                        {{-- Edit --}}
                        <a href="{{ route('penjualan_ternak.edit', $item->id) }}"
                           class="p-2 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 transition" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5l3 3L12 15l-3 1 1-3 9.5-9.5z" />
                            </svg>
                        </a>

                        {{-- Hapus --}}
                        <form action="{{ route('penjualan_ternak.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border px-3 py-4 text-center text-gray-500">Belum ada data penjualan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


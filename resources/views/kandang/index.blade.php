@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <div class="title">
        <div class="text-2xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Data Kandang
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-wrap items-center gap-2 mb-6">
    <a href="{{ route('kandang.create') }}"
       class="inline-block px-4 py-1 bg-blue-500 text-white text-sm font-semibold rounded-full hover:bg-blue-600 transition">
        Tambah Kandang
    </a>

    <input type="text" placeholder="Cari kandang..." id="searchKandang"
           class="border px-3 py-1 rounded-full text-sm w-40 focus:outline-none focus:ring focus:ring-blue-200"
           onkeyup="filterKandang()">
</div>


    <div class="overflow-x-auto bg-white shadow-sm rounded-xl">
    <table class="w-full border-separate border-spacing-0 rounded-xl overflow-hidden shadow-sm">
        <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
            <tr>
                <th class="px-4 py-3 text-center">No</th>
                <th class="px-4 py-3 text-left">ID Kandang</th>
                <th class="px-4 py-3 text-left">Nama</th>
                <th class="px-4 py-3 text-left">Lokasi</th>
                <th class="px-4 py-3 text-left">Penanggung Jawab</th>
                <th class="px-4 py-3 text-left">Jenis Ternak</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-800">
            @foreach($kandang as $k)
            <tr class="hover:bg-gray-50 border-t">
                <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $k->id_kandang }}</td>
                <td class="px-4 py-2">{{ $k->nama }}</td>
                <td class="px-4 py-2">{{ $k->lokasi }}</td>
                <td class="px-4 py-2">{{ $k->penanggung_jawab }}</td>
                <td class="px-4 py-2">{{ $k->jenis_ternak }}</td>
                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center items-center gap-2">
                        <a href="{{ route('kandang.edit', $k->id_kandang) }}"
                           class="text-yellow-500 hover:text-yellow-700" title="Edit">✎</a>
                        <form action="{{ route('kandang.destroy', $k->id_kandang) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">⌦</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-5xl">

    {{-- Judul --}}
    <h2 class="text-2xl font-bold text-gray-900 mb-4">
        Daftar Kategori Ternak
    </h2>

    {{-- Tombol tambah (lebih besar & di kiri) --}}
    <div class="flex justify-start mb-4">
        <a href="{{ route('kategori_ternak.create') }}"
           class="inline-flex items-center gap-3 bg-blue-600 text-white px-6 py-3 
                  rounded-full shadow-lg hover:bg-blue-700 transition text-lg font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Kategori
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel kategori --}}
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-sm text-gray-800">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 w-16 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Kategori</th>
                    <th class="px-4 py-3 w-40 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kategori as $k)
                <tr class="hover:bg-gray-50 border-t">
                    <td class="px-4 py-2">
                        {{ $loop->iteration + ($kategori->currentPage() - 1) * $kategori->perPage() }}
                    </td>

                    <td class="px-4 py-2">{{ $k->nama }}</td>

                    <td class="px-4 py-2">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('kategori_ternak.edit', $k->id) }}"
                               class="px-3 py-1 bg-yellow-400 text-white rounded-full hover:bg-yellow-500 transition">
                                ✎
                            </a>

                            <form action="{{ route('kategori_ternak.destroy', $k->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700 transition">
                                    ⌦
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-3 text-center text-gray-500">
                        Belum ada kategori
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $kategori->links() }}
    </div>

</div>
@endsection

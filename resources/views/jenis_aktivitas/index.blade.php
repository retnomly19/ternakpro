@extends('layouts.app')

@section('header')

@endsection

@section('content')
<div class="max-w-6xl mx-auto py-6">

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif
    <div class="title">
        <div class="text-xl font-bold flex items-center gap-2 text-white-100 pb-4">
            Laporan Aktivitas
        </div>
    </div>

    <div class="flex mb-4 gap-2">
        <a href="{{ route('jenis_aktivitas.create') }}"
           class="bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-2 shadow">
            <!-- Ikon tambah -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Jenis Aktivitas
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg border border-gray-200">
        <table class="w-full border-collapse">
            <thead class="bg-gray-300 text-gray-700">
                <tr>
                    <th class="border px-3 py-2 text-center">No</th>
                    <th class="border px-3 py-2 text-left">Nama</th>
                    <th class="border px-3 py-2 text-left">Keterangan</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisAktivitas as $ja)
                <tr class="hover:bg-blue-50 transition">
                    <td class="border px-3 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="border px-3 py-2 text-left">{{ $ja->nama }}</td>
                    <td class="border px-3 py-2 text-left">{{ $ja->keterangan }}</td>
                    <td class="border px-3 py-2 text-center flex justify-center gap-3">
                        <!-- Edit -->
                        <a href="{{ route('jenis_aktivitas.edit', $ja->id) }}" class="text-yellow-500 hover:text-yellow-700" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.232 5.232l3.536 3.536M9 11l6.232-6.232a2 2 0 112.828 2.828L11.828 13.828a2 2 0 01-1.414.586H9v-1.414a2 2 0 01.586-1.414z"/>
                            </svg>
                        </a>
                        <!-- Hapus -->
                        <form action="{{ route('jenis_aktivitas.destroy', $ja->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="border px-2 py-4 text-center text-gray-500">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

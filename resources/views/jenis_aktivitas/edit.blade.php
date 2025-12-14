@extends('layouts.app')

@section('header')
<div class="flex flex-col items-center gap-2">
    
    
</div>
@endsection

@section('content')
<div class="max-w-lg mx-auto bg-white shadow rounded-lg p-6">
    <!-- Judul Card -->
    <div class="flex items-center justify-center mb-6 border-b pb-3">
        <!-- Ikon SVG Pensil -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="h-6 w-6 text-blue-600 mr-2" 
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M11 4h2m2 0h2a2 2 0 012 2v2m0 2v2m0 2v2a2 2 0 01-2 2h-2m-2 0h-2m-2 0H7a2 2 0 01-2-2v-2m0-2V9m0-2V5a2 2 0 012-2h2" />
        </svg>
        <h3 class="text-xl font-semibold text-gray-800">Edit Jenis Aktivitas</h3>
    </div>

    <!-- Form -->
    <form action="{{ route('jenis_aktivitas.update', $jenisAktivitas->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nama" class="block text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" 
                   value="{{ old('nama', $jenisAktivitas->nama) }}" required
                   class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
        </div>

        <div class="mb-4">
            <label for="keterangan" class="block text-gray-700">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="3"
                      class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">{{ old('keterangan', $jenisAktivitas->keterangan) }}</textarea>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('jenis_aktivitas.index') }}" 
               class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Batal</a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>

</div>
@endsection

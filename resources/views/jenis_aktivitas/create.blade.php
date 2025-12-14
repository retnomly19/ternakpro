@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <!-- Header -->
        <div class="flex flex-col items-center mb-6 border-b pb-3">
            <!-- SVG Ikon Aktivitas -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="w-8 h-8 text-blue-600 mb-2" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 12h6m-6 4h6m2 2H7a2 2 0 01-2-2V6a2 2 0 
                      012-2h10a2 2 0 012 2v10a2 2 0 01-2 2z" />
            </svg>
            <h2 class="text-xl font-bold text-blue-700 text-center">
                Tambah Jenis Aktivitas
            </h2>
        </div>

        <!-- Form -->
        <form action="{{ route('jenis_aktivitas.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nama Jenis Aktivitas -->
            <div>
                <label class="block text-gray-700 font-medium mb-1 text-sm">
                    Nama Jenis Aktivitas
                </label>
                <input type="text" name="nama" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                       placeholder="Masukkan nama aktivitas" required>
            </div>

            <!-- Keterangan -->
            <div>
                <label class="block text-gray-700 font-medium mb-1 text-sm">
                    Keterangan
                </label>
                <textarea name="keterangan" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm"
                          placeholder="Tuliskan keterangan tambahan"></textarea>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('jenis_aktivitas.index') }}"
                   class="flex items-center gap-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-md text-sm transition">
                    <!-- Ikon Cancel -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-4 h-4" fill="none" viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit"
                        class="flex items-center gap-1 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md text-sm transition">
                    <!-- Ikon Save -->
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="w-4 h-4" fill="none" viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

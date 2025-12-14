@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-2xl shadow-lg border border-gray-100">

    {{-- Judul --}}
    <h2 class="text-2xl font-bold mb-5 flex items-center justify-center text-blue-700">
        <!-- Icon pensil -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.232 5.232l3.536 3.536M9 13h6m2 7H7a2 2 0 01-2-2V7a2 2 
                     0 012-2h7l5 5v8a2 2 0 01-2 2z" />
        </svg>
        Edit Aktivitas
    </h2>

    {{-- Form --}}
    <form action="{{ route('aktivitas.update', $aktivitas->id) }}" method="POST" class="space-y-4 text-sm">
        @csrf
        @method('PATCH')

        {{-- Tanggal --}}
        <div>
            <label class="block text-gray-700 mb-1 font-medium">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $aktivitas->tanggal) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
        </div>

        {{-- Kandang --}}
        <div>
            <label class="block text-gray-700 mb-1 font-medium">Kandang</label>
            <select name="id_kandang" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
                <option value="">-- Pilih --</option>
                @foreach($kandang as $k)
                    <option value="{{ $k->id_kandang }}"
                        {{ old('id_kandang', $aktivitas->id_kandang) == $k->id_kandang ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jenis Aktivitas --}}
        <div>
            <label class="block text-gray-700 mb-1 font-medium">Jenis Aktivitas</label>
            <select name="jenis_aktivitas_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400" required>
                <option value="">-- Pilih --</option>
                @foreach($jenisAktivitas as $j)
                    <option value="{{ $j->id }}"
                        {{ old('jenis_aktivitas_id', $aktivitas->jenis_aktivitas_id) == $j->id ? 'selected' : '' }}>
                        {{ $j->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Keterangan --}}
        <div>
            <label class="block text-gray-700 mb-1 font-medium">Keterangan</label>
            <input type="text" name="keterangan"
                   value="{{ old('keterangan', $aktivitas->keterangan) }}"
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('aktivitas.index') }}"
               class="flex items-center px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition">
                <!-- Icon batal -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
                Batal
            </a>
            <button type="submit"
                    class="flex items-center px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow">
                <!-- Icon update -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
                Update
            </button>
        </div>
    </form>

</div>
@endsection

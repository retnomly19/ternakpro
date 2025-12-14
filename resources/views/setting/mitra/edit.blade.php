@extends('layouts.app')

@section('header')
<h2 class="text-2xl font-bold text-white-800 mb-4 text-center">Edit Data Mitra</h2>
@endsection

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mitra.update', $mitra->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- ID --}}
        <div>
            <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
            <input type="text" id="id" value="{{ $mitra->id }}"
                   class="mt-1 block w-full bg-gray-100 text-gray-600 border-gray-300 rounded-lg shadow-sm cursor-not-allowed"
                   readonly>
        </div>

        {{-- Nama --}}
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $mitra->nama) }}"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
        </div>

        {{-- Alamat --}}
        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3"
                      class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">{{ old('alamat', $mitra->alamat) }}</textarea>
        </div>

        {{-- Telepon --}}
        <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
            <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $mitra->telepon) }}"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $mitra->email) }}"
                   class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
        </div>

        {{-- Hubungan --}}
        <div>
            <label for="hubungan" class="block text-sm font-medium text-gray-700">Hubungan</label>
            <select name="hubungan" id="hubungan"
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500">
                <option value="" disabled {{ old('hubungan', $mitra->hubungan) ? '' : 'selected' }}>-- Pilih Hubungan --</option>
                <option value="Pihak Ketiga" {{ old('hubungan', $mitra->hubungan) == 'Pihak Ketiga' ? 'selected' : '' }}>Pihak Ketiga</option>
                <option value="Pihak Berelasi" {{ old('hubungan', $mitra->hubungan) == 'Pihak Berelasi' ? 'selected' : '' }}>Pihak Berelasi</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('mitra.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700 shadow">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

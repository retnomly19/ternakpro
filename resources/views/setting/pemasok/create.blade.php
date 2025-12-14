@extends('layouts.app')

@section('header')
<h2 class="text-xl font-semibold text-white-800 mb-2 text-center">Tambah Pemasok</h2>
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white shadow rounded-xl p-5">

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3 text-sm">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemasok.store') }}" method="POST" class="space-y-3 text-sm">
        @csrf

        {{-- Nama --}}
        <div>
            <label for="nama" class="block text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                   class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
        </div>

        {{-- Alamat --}}
        <div>
            <label for="alamat" class="block text-gray-700 mb-1">Alamat</label>
            <textarea name="alamat" id="alamat" rows="2"
                      class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">{{ old('alamat') }}</textarea>
        </div>

        {{-- Telepon --}}
        <div>
            <label for="telepon" class="block text-gray-700 mb-1">Telepon</label>
            <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}"
                   class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
        </div>

        {{-- Hubungan --}}
        <div>
            <label for="hubungan" class="block text-gray-700 mb-1">Hubungan</label>
            <select name="hubungan" id="hubungan"
                    class="w-full border-gray-300 rounded-md px-3 py-1.5 focus:ring-pink-500 focus:border-pink-500">
                <option value="" disabled selected>-- Pilih Hubungan --</option>
                <option value="Pihak Ketiga" {{ old('hubungan') == 'Pihak Ketiga' ? 'selected' : '' }}>Pihak Ketiga</option>
                <option value="Pihak Berelasi" {{ old('hubungan') == 'Pihak Berelasi' ? 'selected' : '' }}>Pihak Berelasi</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-2 pt-3">
            <a href="{{ route('pemasok.index') }}"
               class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
            <button type="submit"
                    class="px-4 py-1.5 bg-pink-600 text-white rounded hover:bg-pink-700 shadow">Simpan</button>
        </div>
    </form>
</div>
@endsection

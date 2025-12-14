@extends('layouts.app')

@section('header')
<h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">✚ Tambah Kandang</h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white shadow rounded-lg p-6">
       

        <form action="{{ route('kandang.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-semibold text-gray-700">ID Kandang</label>
                    <input type="text" name="id_kandang" value="{{ old('id_kandang') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Nama Kandang</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Lokasi (Desa)</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                {{-- Jenis Ternak Dropdown --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Ternak</label>
                    <div class="border rounded p-3 bg-gray-50">
                        <select name="jenis_ternak" class="w-full px-3 py-2 rounded" required>
                            <option value="">-- Pilih Jenis Ternak --</option>
                            @foreach($kategoriTernak as $kt)
                                <option value="{{ $kt->nama }}" @selected(old('jenis_ternak') == $kt->nama)>{{ $kt->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Kandang</button>
            </div>
        </form>
    </div>
</div>
@endsection

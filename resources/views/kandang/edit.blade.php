@extends('layouts.app')

@section('header')
<h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">✎Edit Data Kandang</h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <form action="{{ route('kandang.update', $kandang->id_kandang) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label>ID Kandang</label>
                <input type="text" name="id_kandang" value="{{ $kandang->id_kandang }}" readonly class="w-full px-3 py-2 border rounded bg-gray-100 cursor-not-allowed">
            </div>

            <div>
                <label>Nama Kandang</label>
                <input type="text" name="nama" value="{{ $kandang->nama }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div>
                <label>Lokasi (Desa)</label>
                <input type="text" name="lokasi" value="{{ $kandang->lokasi }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div>
                <label>Penanggung Jawab</label>
                <input type="text" name="penanggung_jawab" value="{{ $kandang->penanggung_jawab }}" class="w-full px-3 py-2 border rounded" required>
            </div>

            <div>
                <label>Jenis Ternak</label>
                <input type="text" name="jenis_ternak" value="{{ $kandang->jenis_ternak }}" class="w-full px-3 py-2 border rounded" required>
            </div>

        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

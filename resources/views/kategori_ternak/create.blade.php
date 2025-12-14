@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4 max-w-md">
    <h1 class="text-2xl font-semibold mb-4 text-center">✚ Tambah Kategori Ternak</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg p-4">
        <form action="{{ route('kategori_ternak.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Nama Kategori <span class="text-red-600">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" required class="w-full border rounded px-3 py-2 text-sm">
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('kategori_ternak.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

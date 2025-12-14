@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 d-flex align-items-center text-primary">
        <!-- Ikon tambah -->
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5V7.5H11.5a.5.5 0 0 1 0 1H8.5V11.5a.5.5 0 0 1-1 0V8.5H4.5a.5.5 0 0 1 0-1H7.5V4.5A.5.5 0 0 1 8 4z"/>
        </svg>
        Tambah Aktivitas
    </h2>

    <form action="{{ route('aktivitas.store') }}" method="POST" class="shadow p-4 rounded bg-white">
        @csrf

        {{-- Pilih Kandang --}}
        <div class="mb-3">
            <label for="id_kandang" class="form-label fw-bold">Kandang</label>
            <select name="id_kandang" id="id_kandang" class="form-select" required>
                <option value="">-- Pilih Kandang --</option>
                @foreach($kandang as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kandang }}</option>
                @endforeach
            </select>
            @error('id_kandang')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Pilih Jenis Aktivitas --}}
        <div class="mb-3">
            <label for="jenis_aktivitas_id" class="form-label fw-bold">Jenis Aktivitas</label>
            <select name="jenis_aktivitas_id" id="jenis_aktivitas_id" class="form-select" required>
                <option value="">-- Pilih Jenis Aktivitas --</option>
                @foreach($jenisAktivitas as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                @endforeach
            </select>
            @error('jenis_aktivitas_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Pilih Ternak --}}
        <div class="mb-3">
            <label for="id_ternak" class="form-label fw-bold">Ternak</label>
            <select name="ternak[]" id="id_ternak" class="form-select" multiple>
                @foreach($ternak as $t)
                    <option value="{{ $t->id }}">{{ $t->id }} - {{ $t->jenis_ternak }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="mb-3">
            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            @error('tanggal')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control">
            @error('keterangan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label fw-bold">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="schedule" selected>On Schedule</option>
                <option value="process">On Process</option>
                <option value="completed">Completed</option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary d-flex align-items-center">
                <!-- ikon save -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save me-1" viewBox="0 0 16 16">
                    <path d="M8.5 1h-5A1.5 1.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5.5L11 1H8.5zM8 2h2.293L13 4.707V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2.5A.5.5 0 0 1 3.5 2H8z"/>
                    <path d="M5 10.5A1.5 1.5 0 0 1 6.5 9h3A1.5 1.5 0 0 1 11 10.5v3A1.5 1.5 0 0 1 9.5 15h-3A1.5 1.5 0 0 1 5 13.5v-3z"/>
                </svg>
                Simpan
            </button>
            <a href="{{ route('aktivitas.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                <!-- ikon back -->
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
                </svg>
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection

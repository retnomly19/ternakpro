@extends(Auth::user()->role === 'admin' ? 'layouts.app_admin' : 'layouts.app')

@section('header')
<h2 class="text-2xl font-bold text-white flex items-center gap-2">
    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
         d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
    Edit Profil
</h2>
@endsection

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-lg">
    <h3 class="text-lg font-bold text-center mb-6">Edit Profil</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update.custom') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Foto Profil --}}
        <div class="text-center">
            @if (Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                     class="w-24 h-24 mx-auto rounded-full object-cover border mb-2">
            @else
                <div class="w-24 h-24 mx-auto rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mb-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                         d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
            @endif
            <input type="file" name="foto"
                   class="block w-full text-sm text-gray-600 file:mr-4 file:py-1 file:px-3
                          file:rounded-full file:border-0 file:text-sm file:font-semibold
                          file:bg-pink-600 file:text-white hover:file:bg-pink-700 transition">
        </div>

        {{-- Input Fields --}}
        @php
            $fields = [
                ['name' => 'name', 'label' => 'Username', 'type' => 'text', 'icon' => 'user'],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'icon' => 'mail'],
                ['name' => 'job', 'label' => ' Job', 'type' => 'text', 'icon' => 'briefcase'],
                ['name' => 'telepon', 'label' => 'telepon', 'type' => 'text', 'icon' => 'telepon'],
            ];
        @endphp

        @foreach ($fields as $field)
        <div class="relative">
            <label class="block text-sm font-medium text-gray-600 mb-1">{{ $field['label'] }}</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    @if ($field['icon'] === 'user')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                             d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    @elseif ($field['icon'] === 'mail')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                             d="M16 12H8m0 0l-4 4m4-4l-4-4m12 4h-4m0 0l4 4m-4-4l4-4" /></svg>
                    @elseif ($field['icon'] === 'briefcase')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                             d="M6 7V6a2 2 0 012-2h8a2 2 0 012 2v1m-12 0h12m-12 0v10a2 2 0 002 2h8a2 2 0 002-2V7" /></svg>
                    @elseif ($field['icon'] === 'telepon')
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                             d="M3 5a2 2 0 012-2h3.586a1 1 0 01.707.293l2.414 2.414a1 1 0 01.293.707V9a1 1 0 01-1 1H9.414a1 1 0 00-.707.293L6.293 12.707a1 1 0 00-.293.707V15a1 1 0 001 1h3a1 1 0 011 1v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" /></svg>
                    @endif
                </span>
                <input type="{{ $field['type'] }}"
                       name="{{ $field['name'] }}"
                       value="{{ old($field['name'], Auth::user()->{$field['name']}) }}"
                       class="w-full border rounded-full pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring focus:ring-pink-200">
            </div>
        </div>
        @endforeach

        {{-- Tombol --}}
        <div class="flex justify-end gap-2 mt-6">
            <a href="{{ route('profile.index') }}"
               class="px-4 py-2 bg-gray-300 text-sm rounded-full hover:bg-gray-400 transition flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                     d="M6 18L18 6M6 6l12 12" /></svg>
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-pink-600 text-white text-sm font-semibold rounded-full hover:bg-pink-700 transition flex items-center gap-2">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                     d="M5 13l4 4L19 7" /></svg>
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection

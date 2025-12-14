@extends(Auth::user()->role === 'admin' ? 'layouts.app_admin' : 'layouts.app')

@section('header')
<h2 class="text-xl sm:text-2xl font-bold text-white flex items-center justify-start gap-2">
    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
         d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
    Profil {{ Auth::user()->role === 'admin' ? 'Admin' : 'User' }}
</h2>
@endsection

@section('content')
<div class="max-w-sm mx-auto bg-white rounded-xl shadow-lg p-6 text-center">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif
    

    {{-- Foto Profil --}}
    @if($user->foto)
        <img src="{{ asset('storage/'.$user->foto) }}"
             class="w-24 h-24 mx-auto rounded-full object-cover border mb-4">
    @else
        <div class="w-24 h-24 mx-auto rounded-full bg-pink-600 text-white flex items-center justify-center text-3xl font-bold mb-4">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
    @endif

    {{-- Nama & Email --}}
    <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
    <p class="text-gray-600 text-sm mb-4">{{ $user->email }}</p>

    {{-- Info Detail --}}
    <div class="space-y-3 text-sm text-left">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                     d="M6 7V6a2 2 0 012-2h8a2 2 0 012 2v1m-12 0h12m-12 0v10a2 2 0 002 2h8a2 2 0 002-2V7" /></svg>
                <span>Job</span>
            </div>
            <span class="font-medium">{{ $user->job ?? '-' }}</span>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                     d="M3 5a2 2 0 012-2h3.586a1 1 0 01.707.293l2.414 2.414a1 1 0 01.293.707V9a1 1 0 01-1 1H9.414a1 1 0 00-.707.293L6.293 12.707a1 1 0 00-.293.707V15a1 1 0 001 1h3a1 1 0 011 1v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5z" /></svg>
                <span>Telepon</span>
            </div>
            <span class="font-medium">{{ $user->telepon ?? '-' }}</span>
        </div>
    </div>

    {{-- Tombol Edit --}}
    <div class="mt-6">
        <a href="{{ route('profile.edit') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-full hover:bg-blue-600 transition">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                 d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
            Edit Profil
        </a>
    </div>
</div>
@endsection

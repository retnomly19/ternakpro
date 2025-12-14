@extends('layouts.app_admin')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-lg">
    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2 text-gray-800">
        <!-- Ikon User -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        Data Pengguna
    </h1>

    <div class="overflow-x-auto">
       <table class="table-auto w-full border-collapse rounded-lg overflow-hidden shadow">
    <thead>
        <tr class="bg-red-300 text-gray-900 text-sm uppercase font-semibold">
            <th class="px-4 py-3 text-left">ID</th>
            <th class="px-4 py-3 text-left">Nama</th>
            <th class="px-4 py-3 text-left">Email</th>
            <th class="px-4 py-3 text-left">Job</th>
            <th class="px-4 py-3 text-left">Telepon</th>
            <th class="px-4 py-3 text-left">Role</th>
            <th class="px-4 py-3 text-left">Tanggal Register</th>
            <th class="px-4 py-3 text-left">Terakhir Login</th>
        </tr>
    </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t hover:bg-blue-200 text-sm">
                    <td class="px-4 py-2 flex items-center gap-2">
                        <!-- Ikon ID -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4" />
                        </svg>
                        {{ $user->id }}
                    </td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->job ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $user->telepon ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold 
                            {{ $user->role === 'admin' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}</td>
                    <td class="px-4 py-2">    {{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

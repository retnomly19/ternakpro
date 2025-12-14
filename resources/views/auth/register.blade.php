<x-guest-layout>
    {{-- Hilangkan logo bawaan --}}
    <x-slot name="logo"></x-slot>

    
        <!-- Background image -->
        <div class="absolute inset-0 bg-center bg-cover" style="background-image: url('/images/download[1].jpg'); filter: saturate(.95) contrast(.9);"></div>
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 w-full max-w-md px-6">
            <div class="bg-white/90 dark:bg-slate-800/85 rounded-2xl p-8 shadow-2xl">
                <!-- Judul -->
                <h2 class="text-2xl sm:text-3xl font-extrabold text-sky-900 dark:text-sky-200 text-center mb-4">Daftar Akun Baru</h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-6 text-slate-900 dark:text-slate-100">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" class="text-slate-700 dark:text-slate-300" />
                    <x-text-input id="name"
                        class="block mt-1 w-full rounded-md bg-white border border-slate-200 text-slate-900 placeholder-slate-400 
                               focus:ring-2 focus:ring-sky-300 focus:outline-none shadow-sm"
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Masukkan nama lengkap" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-200" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-slate-700 dark:text-slate-300" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-md bg-white border border-slate-200 text-slate-900 placeholder-slate-400 
                               focus:ring-2 focus:ring-sky-300 focus:outline-none shadow-sm"
                        type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Masukkan email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300" />
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-md bg-white border border-slate-200 text-slate-900 placeholder-slate-400 
                               focus:ring-2 focus:ring-sky-300 focus:outline-none shadow-sm"
                        type="password" name="password" required autocomplete="new-password"
                        placeholder="Masukkan password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-slate-700 dark:text-slate-300" />
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full rounded-md bg-white border border-slate-200 text-slate-900 placeholder-slate-400 
                               focus:ring-2 focus:ring-sky-300 focus:outline-none shadow-sm"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Konfirmasi password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <a class="text-sm text-slate-600 dark:text-slate-300 hover:underline" href="{{ route('login') }}">{{ __('Sudah punya akun? Login') }}</a>

                    <x-primary-button class="ms-3 bg-sky-600 hover:bg-sky-700 text-white px-6 py-2 rounded-lg shadow transition transform hover:scale-105">{{ __('Register') }}</x-primary-button>
                </div>
            </form>
            </div>
        </div>
    </div>
</x-guest-layout>

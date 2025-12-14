<x-guest-layout>
    {{-- Hilangkan logo bawaan --}}
    <x-slot name="logo"></x-slot>

    
    <!-- Background image (full-screen fixed) -->
    <div class="absolute inset-0 bg-center bg-cover bg-fixed" style="background-image: url('/images/download[1].jpg'); filter: saturate(.95) contrast(.9); background-attachment: fixed;"></div>
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 w-full max-w-3xl px-6">
            <!-- Card (wider for a full feel) -->
            <div class="bg-white/90 dark:bg-slate-800/85 rounded-2xl p-8 shadow-2xl">
                <!-- Judul -->
                <h2 class="text-2xl sm:text-3xl font-extrabold text-sky-900 dark:text-sky-200 text-center mb-4">
                    Login ke Sistem Peternakan
                </h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-sm text-slate-700 dark:text-slate-300" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6 text-slate-900 dark:text-slate-100">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <!-- Ikon Email -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 12H8m8-4H8m-2 8h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </span>
                        <x-text-input id="email"
                            class="block mt-1 w-full pl-10 rounded-md bg-white border border-slate-200 text-slate-900 placeholder-slate-400 
                                   focus:ring-2 focus:ring-sky-300 focus:outline-none shadow-sm"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            placeholder="Masukkan email" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <!-- Ikon Kunci -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 11c0-1.104-.896-2-2-2s-2 .896-2 2 .896 2 2 2 2-.896 2-2zm-2 4a4 4 0 100-8 4 4 0 000 8zm10-2v-1a6 6 0 10-12 0v1H6v6h12v-6h-2z" />
                            </svg>
                        </span>
                        <x-text-input id="password"
                            class="block mt-1 w-full pl-10 rounded-md bg-white border border-slate-200 text-slate-900 placeholder-slate-400 
                                   focus:ring-2 focus:ring-sky-300 focus:outline-none shadow-sm"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Login As -->
                <div>
                    <x-input-label for="role" :value="__('Login Sebagai')" class="text-slate-700 dark:text-slate-300" />
                    <select id="role" name="role"
                        class="block mt-1 w-full rounded-md bg-white border border-slate-200 text-slate-900 
                               focus:ring-2 focus:ring-sky-300 focus:outline-none shadow-sm">
                        <option value="user" class="text-slate-900">User</option>
                        <option value="admin" class="text-slate-900">Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2 text-red-200" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-sky-600 shadow-sm focus:ring-sky-400"
                        name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-slate-700 dark:text-slate-300">{{ __('Ingat saya') }}</label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    <div>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-slate-600 dark:text-slate-300 hover:text-slate-800" href="{{ route('password.request') }}">{{ __('Lupa password?') }}</a>
                        @endif
                    </div>

                    <x-primary-button class="ms-3 bg-sky-600 hover:bg-sky-700 text-white px-6 py-2 rounded-lg shadow transition transform hover:scale-105">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Link ke Register -->
                <div class="mt-4 text-center">
                    <span class="text-sm text-slate-700 dark:text-slate-300">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-sky-600 hover:underline ml-1">Daftar di sini</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</x-guest-layout>

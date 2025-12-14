<!-- resources/views/navigation-menu.blade.php -->
<div class="relative">
    <!-- Trigger Avatar -->
    <button @click="open = !open" class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none transition">
        <img class="h-10 w-10 rounded-full object-cover" 
             src="{{ Auth::user()->photo ? asset(Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}" 
             alt="{{ Auth::user()->name }}" />
    </button>

    <!-- Dropdown -->
    <div x-show="open" class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg z-50 p-4 space-y-2">
        <div class="flex items-center space-x-4">
            <img class="h-12 w-12 rounded-full object-cover" 
                 src="{{ Auth::user()->photo ? asset(Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}" 
                 alt="Foto Profil">
            <div>
                <h3 class="font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                <p class="text-sm text-gray-600">WA: {{ Auth::user()->telepon }}</p>
                <p class="text-sm text-gray-600">Email: {{ Auth::user()->email }}</p>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Edit Profil
        </a>
    </div>
</div>

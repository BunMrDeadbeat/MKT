@props(['headerTitle' => 'Dashboard'])

<header class="header bg-white border-b border-gray-200 py-4 px-6 flex items-center justify-between sticky top-0">
    <div class="flex items-center">
        <button onclick="toggleSidebar()" class="mx-4 text-gray-600 hover:text-gray-900">
            <i class="text-xl bg-gray-400 rounded-l p-3"><<</i>
        </button>
        <h1 class="text-xl font-semibold">{{ $headerTitle }}</h1>
    </div>

    <div class="flex items-center space-x-4">
        


        <div class="w-px h-8 bg-gray-200"></div>

        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <div class="flex items-center cursor-pointer" @click="open = !open">
                <img src="{{ asset('storage/images/favicon.png') }}" alt="Foto de perfil de usuario"
                    class="w-8 h-8 rounded-full mr-2">
                <span class="font-medium">
                    {{ auth()->check() ? auth()->user()->name : 'Invitado' }}
                </span>
                <svg class="w-4 h-4 ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20" style="display: none;"> <a
                    href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Home Page
                </a>
        
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<!DOCTYPE html>

@extends('components.metadataHead')
@section('LayoutBody')
    <header class="bg-white shadow flex-auto">
        <nav
            class="bg-mktPurple p-4 shadow-lg hover:bg-indigo-950 hover:shadow-lime-500/50 duration-300 ease-in sticky top-0 z-50">
            <div class="flex items-center justify-between">
            <div class="container mx-4 flex justify-between items-center">
                <a href="{{route( 'user.dash') }}" class="text-white text-3xl font-extrabold stroke-10 stroke-black px-4">D<span class="text-mktGreen">u</span>rán<span class="text-mktGreen">MKT</span> <span class=" text-sm text-gray-400">
                    Bienvenidos <span class="text-xl text-amber-100 mx-4">   {{ auth()->check() ? auth()->user()->name : '' }}</span>
                 </a>
                <div id="menu-toggle" class="space-x-6 py-2 my-3 border-mktGreen border-2 rounded-2xl p-3">
                    <a href="#inicio" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"
                        class="text-gray-300 hover:text-white transition text-lg font-bold">Inicio</a>
                    <a href="{{ '/store' }}" class="text-gray-300 hover:text-white transition text-lg font-bold">Nuestra Tienda</a>
                    <a href="{{ '/admin' }}" class="text-gray-300 hover:text-white transition text-lg font-bold">Admin</a>
                </div>
            </div>
            <div>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-amber-400 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-mktGreen hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out inline-block">
                        Login
                    </a>
                @endauth
            </div>
            </div>
        </nav>
    </header>
    <main >
        @yield('content')
    </main>
    <footer class="bg-white shadow mt-6">
        <div class="container mx-auto px-4 py-6 text-center">
            <p>&copy; {{ date('Y') }} DuranMKT. Derechos reservados</p>
        </div>
    </footer>
@endsection
</html>
<!DOCTYPE html>

@extends('components.metadataHead')
@section('LayoutBody')
    <header class="bg-mktPurple shadow flex-auto">
        <nav
            class="bg-mktPurple p-3 shadow-lg hover:bg-indigo-950 hover:shadow-lime-500/50 duration-300 ease-in sticky top-0 z-50  ">
            <div class="flex flex-col items-center gap-3 md:flex-row md:justify-between md:gap-0">
            <div class="container mx-auto px-1 flex justify-between items-center">
                <a  class="text-white text-3xl font-extrabold  pl-1">D<span class="text-mktGreen">u</span>rán<span class="text-mktGreen">MKT</span> <span class=" text-sm text-gray-400">
                    Bienvenidos
                 </a>
                <div id="menu-toggle" class="flex flex-col space-y-2 md:flex-row md:space-x-6 md:space-y-0 py-2 mx-3 border-mktGreen border-2 rounded-2xl p-3 underline decoration-mktGreen underline-offset-8">
                    <a href="#inicio" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"
                        class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-green-900">Inicio</a>
                    <a href="{{ '/store' }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-purple-900">Tienda</a>
                    <a href="{{ '/admin' }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-green-900">Admin</a>
                    <a href="{{route( 'user.dash') }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-indigo-900">  {{ auth()->check() ? auth()->user()->name : '' }}</a>
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
@extends('components.metadataHead')
@section('LayoutBody')
    {{-- <header class="bg-mktPurple shadow flex-auto md:sticky top-0 z-50">
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
                    
                    @auth
                        @if (auth()->user()->roles->first()->id === 1)
                        <a href="{{ '/admin' }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-green-900">Admin</a>
                        @endif
                        <a href="{{route( 'user.dash') }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-indigo-900">  {{ auth()->check() ? auth()->user()->name : '' }} </a>  
                        @isset(auth()->user()->cart)
                            <a href="{{route( name: 'cart.load') }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-indigo-900 "> <i class="fas fa-shopping-cart"></i> ({{ auth()->user()->cart->productos()->count() }})</a>  
                        @endisset
                        
                       

                    @endauth
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
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="bg-mktGreen hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out inline-block">
                        Login
                    </a>
                     <a href="{{ route('register') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out inline-block">
                        Registro
                    </a>
                </div>
                @endauth
            </div>
            </div>
        </nav>
    </header> --}}
    <header class="bg-mktPurple shadow flex-auto md:sticky top-0 z-50">
        <nav class="container mx-auto p-3 flex justify-between items-center relative">
            <a href="/" class="text-white text-3xl font-extrabold pl-1">
                D<span class="text-mktGreen">u</span>rán<span class="text-mktGreen">MKT</span>
                <span class="text-sm text-gray-400">Bienvenidos</span>
            </a>

            <button id="menu-btn" class="md:hidden focus:outline-none p-2 relative z-10" aria-label="Open Menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-mktGreen" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div id="menu" class="hidden md:flex md:items-center md:w-auto w-full md:static absolute top-full left-0 bg-mktPurple z-20 shadow-lg">
         
                <div class="flex flex-col md:flex-row items-center gap-4 p-5 md:p-0">

                    <div class="flex flex-col md:flex-row items-center gap-4 md:space-x-2 py-2 md:border-mktGreen md:border-2 md:rounded-2xl md:p-3 underline decoration-mktGreen underline-offset-8">
                        <a href="#inicio" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-green-900">Inicio</a>
                        <a href="{{ '/store' }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-purple-900">Tienda</a>
                        
                        @auth
                            @if (auth()->user()->roles->first()->id === 1)
                                <a href="{{ '/admin' }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-green-900">Admin</a>
                            @endif
                            <a href="{{ route('user.dash') }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-indigo-900">{{ auth()->user()->name }}</a>
                            @isset(auth()->user()->cart)
                                <a href="{{ route('cart.load') }}" class="text-gray-300 hover:text-white transition text-lg font-bold rounded-sm px-2 bg-indigo-900"><i class="fas fa-shopping-cart"></i> ({{ auth()->user()->cart->productos()->count() }})</a>
                            @endisset
                        @endauth
                    </div>

                    <div class="flex items-center space-x-4">
                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-amber-400 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="bg-mktGreen hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
                                Registro
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <x-closable-alert />
    <main>
        @yield('content')
    </main>
    <footer class="bg-white shadow mt-6">
        <div class="container mx-auto px-4 py-6 text-center">
            <p>&copy; {{ date('Y') }} DuranMKT. Derechos reservados</p>
        </div>
    </footer> 
        
@endsection
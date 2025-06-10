@extends('components.metadataHead')
@section('title', 'DurankMKT | Store')
@section('description', 'Tienda DuranMkt')
@section('LayoutBody')
        <header class="bg-primary text-white shadow-md">
            <div class="container mx-auto px-3 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <a  href="{{ url('/')}}" >
                            <i class="fas fa-house"></i>
                            <span>Inicio</span>
                        </a>
                        <a  href="{{ url('/store')}}" >
                            <i class="fas fa-store"></i>
                            <span>Tienda</span> 
                        </a>
                        <div class="flex items-center space-x-1">
                            <i class="fas fa-power-off text-mktGreen text-2xl sm:hidden"></i>
                            <h1 class="text-2xl font-bold">DURAN<span class="text-mktGreen">MKT</span><span class="text-sm"> store</h1>
                        </div>
                    </div>
                    <nav class="hidden md:flex space-x-6 items-center">
                        <a href="{{route('user.dash') }}" class="hover:text-accent"><i class="fas fa-user"></i></a>
                        <a href="#" class="flex items-center space-x-1 hover:text-accent">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Carrito (COMING SOON)</span>
                        </a>
                    </nav>
                    <button class="md:hidden text-xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        @yield('content')

        <footer class="bg-primary text-white py-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">DURAN<span class="text-accent">MKT</span></h3>
                        <p class="mb-4">Soluciones de marketing personalizadas para hacer crecer tu negocio.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="hover:text-accent"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="hover:text-accent"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="hover:text-accent"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    
                        @if (isset($productos))
                    <div>
                        
                        <h4 class="font-bold mb-4 text-accent">Productos</h4>
                        <ul class="space-y-2">
                                @php
                                    $productosFiltrados = $productos->where('type', 'product');
                                @endphp
                                @if($productosFiltrados->count() >= 4)
                                    @foreach($productosFiltrados->random(4) as $producto)
                                        <li><a href="#" class="hover:text-accent">{{ $producto->name }}</a></li>
                                    @endforeach
                                @else
                                    <li><span class="text-gray-500">Disponibles en contacto.</span></li>
                                @endif
                            

                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold mb-4 text-accent">Servicios</h4>
                        <ul class="space-y-2">
                            @php
                            $productosFiltrados = $productos->where('type', 'service');
                            @endphp
                            @if($productosFiltrados->count() >= 4)
                                @foreach($productosFiltrados->random(4) as $producto)
                                    <li><a href="#" class="hover:text-accent">{{ $producto->name }}</a></li>
                                @endforeach
                            @else
                                <li><span class="text-gray-500">Contactarse para más información.</span></li>
                            @endif
                        </ul>
                    </div>
                    @endif
                    <div>
                        <h4 class="font-bold mb-4 text-accent">Contacto</h4>
                        <p class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i> Alvaro Obregon 4181, Nogales, Sonora, México</p>
                        <p class="mb-2"><i class="fas fa-phone mr-2"></i> +52 631-126-0295</p>
                        <p class="mb-2"><i class="fas fa-envelope mr-2"></i> Durannogales@gmail.com</p>
                    </div>
                </div>
                <div class="border-t border-purple-700 mt-8 pt-6 text-center">
                    <p>&copy; {{ date('Y') }} DURANMKT. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>
@endsection
@extends('components.metadataHead')
@section('title', 'DurankMKT | Store')
@section('description', 'Tienda DuranMkt')
@section('styles')
@endsection
@section('LayoutBody')
    <header class="bg-primary text-white shadow-md">
        <div class="container mx-auto px-3 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ '/' }}" class="back-btn">
                        <i class="fas fa-arrow-left"></i>
                        <span>Volver</span>
                    </a>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-power-off text-mktGreen text-2xl"></i>
                        <h1 class="text-2xl font-bold">DURAN<span class="text-mktGreen">MKT</span><span class="text-sm"> store</h1>
                    </div>
                </div>
                <nav class="hidden md:flex space-x-6 items-center">
                    <a href="{{route( 'user.dash') }}" class="hover:text-accent"><i class="fas fa-user"></i></a>
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
                <div>
                    <h4 class="font-bold mb-4 text-accent">Productos</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-accent">Vinilos</a></li>
                        <li><a href="#" class="hover:text-accent">Tarjetas</a></li>
                        <li><a href="#" class="hover:text-accent">Etiquetas</a></li>
                        <li><a href="#" class="hover:text-accent">Pegatinas</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-accent">Servicios</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-accent">Diseño Gráfico</a></li>
                        <li><a href="#" class="hover:text-accent">Marketing Digital</a></li>
                        <li><a href="#" class="hover:text-accent">Branding</a></li>
                        <li><a href="#" class="hover:text-accent">SEO</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-accent">Contacto</h4>
                    <p class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i> Av. Principal 123, Ciudad</p>
                    <p class="mb-2"><i class="fas fa-phone mr-2"></i> +1 234 567 890</p>
                    <p class="mb-2"><i class="fas fa-envelope mr-2"></i> info@duranmkt.com</p>
                </div>
            </div>
            <div class="border-t border-purple-700 mt-8 pt-6 text-center">
                <p>&copy; {{ date('Y') }} DURANMKT. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    @yield('scripts')
@endsection
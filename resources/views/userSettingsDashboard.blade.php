<!DOCTYPE html>
<html lang="es" class="dark"> {{-- Añadido 'dark' para activar el modo oscuro de Tailwind --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario - {{ $user->name }}</title>
     @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css') }}">
    <script defer src="{{ url('https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js') }}"></script>
    <style>
        .dark input, .dark select {
            background-color: #374151; 
            border-color: #4b5563; 
            color: #d1d5db; 
            transition: all 0.3s ease-in-out;
        }
        .dark input:focus, .dark select:focus { 
            outline: none;
            --tw-ring-color: #7c3aed;
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
            border-color: #7c3aed;
        }
        .group:hover .group-hover\:block {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-300 font-sans">

    {{-- INICIO DEL HEADER --}}
    <header x-data="{ mobileMenuOpen: false }" class="bg-gray-800 shadow-lg sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo o Nombre de la Tienda --}}
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}">
                        <img class="h-10 w-auto" src="{{ asset('storage/images/logo.png') }}" alt="MiTienda Logo">
                    </a>
                </div>

                {{-- Navegación Principal (Escritorio) --}}
                <div class="hidden md:flex md:items-center md:space-x-8">
                    <a href="{{ url('/') }}" class="text-gray-300 hover:text-violet-400 transition-colors">Inicio</a>
                    <a href="{{ url('/store') }}" class="text-gray-300 hover:text-violet-400 transition-colors">Tienda</a>
                </div>

                {{-- Iconos de la derecha y Menú de Usuario (Escritorio) --}}
                <div class="hidden md:flex items-center space-x-5">
                    <a href="{{ url('/carrito') }}" class="text-gray-300 hover:text-violet-400 relative">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                    </a>
                    
                    {{-- Menú Desplegable de Usuario --}}
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-300 hover:text-violet-400">
                            <i class="fas fa-user-circle fa-lg"></i>
                            <span class="font-medium">{{ $user->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-md shadow-lg py-1 z-20 hidden group-hover:block">
                            <a href="{{ route('user.dash') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-violet-500 hover:text-white">Mi Panel</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-300 hover:bg-violet-500 hover:text-white">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Botón de Menú Móvil --}}
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-300 hover:text-violet-400 focus:outline-none">
                        <i class="fas" :class="{ 'fa-bars': !mobileMenuOpen, 'fa-times': mobileMenuOpen }"></i>
                    </button>
                </div>
            </div>

            {{-- Menú Móvil Desplegable --}}
            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" class="md:hidden pb-4">
                 <a href="{{ url('/') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700">Inicio</a>
                 <a href="{{ url('/store') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700">Tienda</a>
                 <a href="{{ url('/carrito') }}" class="block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700">Carrito</a>
                 <a href="{{ route('user.dash') }}" class="block py-2 px-4 text-sm text-gray-300 font-semibold hover:bg-gray-700">Mi Panel</a>
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf
                     <button type="submit" class="w-full text-left block py-2 px-4 text-sm text-gray-300 hover:bg-gray-700">
                         Cerrar Sesión
                     </button>
                 </form>
            </div>
        </nav>
    </header>
    {{-- FIN DEL HEADER --}}

    <div class="container mx-auto p-4 sm:p-6 lg:p-8">

        @if(session('success'))
            <div class="bg-green-900 border-l-4 border-green-500 text-green-300 p-4 mb-6" role="alert">
                <p class="font-bold">Éxito</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
               {{-- INICIO DE LA NUEVA SECCIÓN DE ÓRDENES CON MODAL --}}
<div x-data="orderModal()">
    <section class="bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-gray-200">Mis Órdenes</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Folio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Detalles</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">{{ $order->folio }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($order->status == 'completado') bg-green-900 text-green-300
                                @elseif($order->status == 'procesando') bg-blue-900 text-blue-300
                                @elseif($order->status == 'pendiente') bg-yellow-900 text-yellow-300
                                @else bg-red-900 text-red-300 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <button @click="show({{ $order->id }})" class="text-violet-400 hover:text-violet-300 font-semibold">
                                <i class="fas fa-eye mr-1"></i> Ver Detalle
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No tienes órdenes registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </section>

    <div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">
        <div @click="isOpen = false" class="fixed inset-0 bg-gray-900 bg-opacity-75"></div>

        <div class="relative bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] flex flex-col">
            <div class="flex justify-between items-center p-4 border-b border-gray-700">
                <h3 class="text-lg font-medium text-gray-200">Detalles de la Orden <span x-text="order.folio" class="font-bold text-violet-400"></span></h3>
                <button @click="isOpen = false" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times h-6 w-6"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto space-y-6">
                <template x-if="order.status !== 'cancelado'">
                    <div>
                        <h4 class="text-xl font-semibold text-gray-200 mb-4">Estado del Pedido</h4>
                        <div class="flex items-center">
                            <div class="flex flex-col items-center text-center relative">
                                <div class="rounded-full h-8 w-8 flex items-center justify-center" :class="progressStatus >= 1 ? 'bg-violet-500' : 'bg-gray-600'">
                                    <i class="fas fa-receipt text-white"></i>
                                </div>
                                <p class="text-xs mt-1" :class="progressStatus >= 1 ? 'text-violet-400' : 'text-gray-400'">Pendiente</p>
                            </div>
                            <div class="flex-auto border-t-2 transition-colors duration-500" :class="progressStatus >= 2 ? 'border-violet-500' : 'border-gray-600'"></div>
                            <div class="flex flex-col items-center text-center relative">
                                <div class="rounded-full h-8 w-8 flex items-center justify-center" :class="progressStatus >= 2 ? 'bg-violet-500' : 'bg-gray-600'">
                                    <i class="fas fa-box-open text-white"></i>
                                </div>
                                <p class="text-xs mt-1" :class="progressStatus >= 2 ? 'text-violet-400' : 'text-gray-400'">Procesando</p>
                            </div>
                            <div class="flex-auto border-t-2 transition-colors duration-500" :class="progressStatus >= 3 ? 'border-violet-500' : 'border-gray-600'"></div>
                            <div class="flex flex-col items-center text-center relative">
                                <div class="rounded-full h-8 w-8 flex items-center justify-center" :class="progressStatus >= 3 ? 'bg-violet-500' : 'bg-gray-600'">
                                    <i class="fas fa-check-circle text-white"></i>
                                </div>
                                <p class="text-xs mt-1" :class="progressStatus >= 3 ? 'text-violet-400' : 'text-gray-400'">Completado</p>
                            </div>
                        </div>
                    </div>
                </template>
                 <template x-if="order.status === 'cancelado'">
                    <div class="p-4 bg-red-900/50 border border-red-700 text-red-300 rounded-lg text-center">
                        <i class="fas fa-times-circle fa-2x mb-2"></i>
                        <h4 class="text-xl font-semibold">Orden Cancelada</h4>
                    </div>
                </template>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="p-4 bg-gray-700/50 rounded-lg">
                        <p class="text-gray-400 font-medium">Nombre del Cliente:</p>
                        <p x-text="order.user.name" class="text-gray-200 font-semibold"></p>
                    </div>
                    <div class="p-4 bg-gray-700/50 rounded-lg">
                        <p class="text-gray-400 font-medium">Fecha de la Orden:</p>
                        <p x-text="new Date(order.created_at).toLocaleDateString('es-ES')" class="text-gray-200"></p>
                    </div>
                </div>

                <div>
                    <h4 class="text-xl font-semibold text-gray-200 mb-4">Productos</h4>
                    <div class="space-y-4">
                        <template x-for="item in order.product" :key="item.id">
                            <div class="p-4 bg-gray-700/50 rounded-lg shadow-sm">
                                <div class="flex flex-col sm:flex-row items-center gap-4">
                                    <img :src="`/storage/${item.producto.galleries.find(g => g.is_featured)?.image || ''}`" :alt="item.producto.name" class="w-24 h-24 object-cover rounded flex-shrink-0">
                                    <div class="flex-grow text-center sm:text-left">
                                        <p class="font-semibold text-lg text-gray-200" x-text="item.producto.name"></p>
                                        <p class="text-sm text-gray-400" x-text="`Cantidad: ${item.cantidad}`"></p>
                                        <p class="text-sm text-gray-400" x-text="`Precio Unitario: $${parseFloat(item.precio_unitario).toFixed(2)}`"></p>
                                    </div>
                                </div>
                                <template x-if="item.opciones && item.opciones.filter(opt => opt.option_name !== 'no_cotizacion').length > 0">
                                    <div class="mt-4 pt-3 border-t border-gray-600">
    <p class="text-sm font-semibold text-gray-300 mb-2">Opciones:</p>
    <div class="space-y-3 text-sm text-gray-400">
        <template x-for="opcion in item.opciones.filter(opt => opt.option_name !== 'no_cotizacion')" :key="opcion.id">
            <div>
                {{-- Condición: Si la opción es un Diseño, muéstrala como imagen --}}
                <template x-if="opcion.option_name.toLowerCase() === 'design'">
                    <div>
                        <strong class="text-gray-300">Diseño Personalizado:</strong>
                        <a :href="`/storage/${opcion.option_value}`" target="_blank" title="Ver diseño en tamaño completo">
                            <img :src="`/storage/${opcion.option_value}`" alt="Diseño del usuario" class="mt-2 w-full max-w-xs h-auto rounded-lg border-2 border-gray-600 hover:border-violet-500 transition-colors">
                        </a>
                    </div>
                </template>

                {{-- Caso contrario: Muestra la opción como texto normal --}}
                <template x-if="opcion.option_name.toLowerCase() !== 'design'">
                    <p>
                        <strong class="text-gray-300" x-text="`${opcion.option_name.replace(/_/g, ' ').replace(/^\w/, c => c.toUpperCase())}: `"></strong>
                        <span x-text="opcion.option_value"></span>
                    </p>
                </template>
            </div>
        </template>
    </div>
</div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <section class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-200">Modificar Perfil</h2>
                    <form action="{{ route('user.update.profile') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-400">Nombre</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md shadow-sm p-2">
                                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-400">Correo Electrónico</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md shadow-sm p-2">
                                @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-400">Teléfono</label>
                                <input type="tel" name="telefono" id="telefono" value="{{ old('telefono', $user->telefono) }}" class="mt-1 block w-full rounded-md shadow-sm p-2">
                                 @error('telefono') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit" class="bg-violet-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-violet-700 transition-colors">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

            <aside class="space-y-8">
                <section class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-200">Cambiar Contraseña</h2>
                    <form action="{{ route('user.update.password') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-400">Contraseña Actual</label>
                                <input type="password" name="current_password" id="current_password" class="mt-1 block w-full rounded-md shadow-sm p-2">
                                @error('current_password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-400">Nueva Contraseña</label>
                                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md shadow-sm p-2">
                                @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-400">Confirmar Nueva Contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md shadow-sm p-2">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="bg-violet-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-violet-700 transition-colors">
                                    Cambiar Contraseñ
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
            </aside>
        </div>
    </div>
    <script>
function orderModal() {
    return {
        isOpen: false,
        order: { user: {}, products: [] }, // Estado inicial para evitar errores
        progressStatus: 0,
        async show(orderId) {
            this.isLoading = true;
            try {
                const response = await fetch(`/user/orders/${orderId}`);
                if (!response.ok) throw new Error('Error al cargar la orden.');
                
                this.order = await response.json();

                // Lógica de la barra de progreso
                const statuses = { 'pendiente': 1, 'procesando': 2, 'completado': 3, 'cancelado': 0 };
                this.progressStatus = statuses[this.order.status] || 0;

                this.isOpen = true;
            } catch (error) {
                console.error(error);
                // Aquí podrías mostrar una notificación de error al usuario
            } finally {
                this.isLoading = false;
            }
        }
    }
}
</script>
</body>
</html>

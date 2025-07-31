<style>
    .sidebar.collapsed {
        width: 0;
        transition: all 0.5s ease;
    }
    
</style>
<div class="sidebar from-mktPurple to-green-700 bg-gradient-to-t text-white md:w-1/4 w-40 border border-black flex flex-col">
    <div class="p-3 items-center bg-mktPurple">
        <a  href="{{ route('home') }}">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="h-10 mr-2" /></a>
    </div>

    <div class="flex-1 overflow-y-auto justify-between">
        <nav class="my-3 py-3">
            <div class="px-2 py-3 text-l uppercase text-mktPurple font-bold flex items-center ">Administración</div>
            <div class="px-4 py-2 text-xs uppercase text-blue-200 font-semibold  from-teal to-black bg-gradient-to-l">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="border-y-3 border-green-950 nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.lander') }}" class="border-b-3 border-green-950 nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.lander') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-plane-arrival mr-3"></i>
                <span class="nav-text">Landing page</span>
            </a>
            <div class="px-4 py-2 text-xs uppercase text-blue-200 font-semibold  from-teal to-black bg-gradient-to-l">Tienda</div>
            <a href="{{ route('admin.products') }}" class="border-b-3 border-green-950 nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.products') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-box mr-3"></i>
                <span class="nav-text">Productos</span>
            </a>

            <a href="{{ route('admin.options') }}"
                class="border-b-3 border-green-950 nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{ request()->routeIs('admin.options*') ? 'bg-indigo-600' : 'bg-green-700' }} transition">
                <i class="fas fa-cogs mr-3"></i>
                <span class="nav-text">Opciones</span>
            </a>

            <a href="{{ route('admin.categories') }}" class="border-b-3 border-green-950 nav-item flex items-center px-10 pt-1 pb-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.categories') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-box mr-3"></i>
                <span class="nav-text">Categorías</span>
            </a>
            <div class="px-4 py-2 text-xs uppercase text-blue-200 font-semibold  from-teal to-black bg-gradient-to-l">Clientes</div>
            
            <a href="{{ route('admin.orders') }}" class="border-b-3 border-green-950 nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.orders') ? 'bg-indigo-600' : ' bg-green-700' }}  transition"   >
                <i class="fas fa-shopping-cart mr-3"></i>
                <span class="nav-text">Ordenes</span>
            </a>
            <div class="px-4 py-2 text-xs uppercase text-blue-200 font-semibold  from-teal to-black bg-gradient-to-l">Administración</div>
            
            <a href="{{ route('admin.users') }}" class="border-b-3 border-green-950 nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.users') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-users mr-3"></i>
                <span class="nav-text">Usuarios</span>
            </a>
            <a href="{{ route('admin.notification_recipients.index') }}" class="border-b-3 border-green-950 nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.notification_recipients.index') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-envelope mr-3"></i>
                <span class="nav-text">Recepción de Notificaciones</span>
            </a>
        </nav>
    </div>
    

</div>
</button>

<style>
    .sidebar.collapsed {
        width: 0;
        transition: all 0.5s ease;
    }
    
</style>
<div class="sidebar bg-green-700 text-white md:w-1/4  flex flex-col w-40 border-1 border-black border-solid">
    <div class="p-3 items-center bg-mktPurple">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="h-10 mr-2" href="{{ route('home') }}" />
    </div>

    <div class="flex-1 overflow-y-auto">
        <nav class="my-3 py-3">
            <div class="px-2 py-3 text-l uppercase text-mktPurple font-bold flex items-center ">Administracion</div>
            <div class="px-4 py-2 text-xs uppercase text-blue-200 font-semibold  bg-green-900">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.dashboard') ?  'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-tachometer-alt mr-3"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="{{ route('admin.lander') }}" class="nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.lander') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-plane-arrival mr-3"></i>
                <span class="nav-text">Landing page</span>
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.users') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-users mr-3"></i>
                <span class="nav-text">Usuarios</span>
            </a>
            <a href="{{ route('admin.products') }}" class="nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.products') ? 'bg-indigo-600' : ' bg-green-700' }} transition"   >
                <i class="fas fa-box mr-3"></i>
                <span class="nav-text">Productos</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item flex items-center px-4 py-3 text-white hover:bg-mktPurple {{  request()->routeIs('admin.orders') ? 'bg-indigo-600' : ' bg-green-700' }}  transition"   >
                <i class="fas fa-shopping-cart mr-3"></i>
                <span class="nav-text">Ordenes</span>
            </a>

            
        </nav>
    </div>
    

</div>
</button>
@section('scripts')
    <script>
    //actualizar con ajax, no es la funcion de abajo. Es recordatorio GERMAN PADILLA
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        
        sidebar.classList.toggle('collapsed');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    }
    window.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        document.querySelector('.sidebar').classList.add('collapsed');
    }
});
    </script>
    @endsection
<style>
  .sidebar.collapsed {
    width: 0;
    transition: all 0.5s ease;
  }
</style>

<div class="sidebar from-mktPurple to-green-700 bg-gradient-to-t text-white flex flex-col md:w-1/4 w-64 shadow-xl">
  
  <div class="p-4 flex items-center justify-center border-b border-white/10">
    <a href="{{ route('home') }}">
      <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="h-10" />
    </a>
  </div>

  <div class="flex-1 overflow-y-auto">
    <nav class="p-4">
      
      <div>
        <div class="px-3 pb-2 text-xs font-bold uppercase text-white/60 tracking-wider">Principal</div>
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
          <i class="fas fa-tachometer-alt fa-fw mr-3"></i>
          <span class="nav-text">Dashboard</span>
        </a>
        <a href="{{ route('admin.lander') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.lander') ? 'bg-white/20' : '' }}">
          <i class="fas fa-plane-arrival fa-fw mr-3"></i>
          <span class="nav-text">Landing Page</span>
        </a>
        <a href="{{ route('admin.partners') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.partners') ? 'bg-white/20' : '' }}">
          <i class="fas fa-handshake fa-fw mr-3"></i>
          <span class="nav-text">Logos de Clientes Destacados</span>
        </a>
      </div>
      
      <div class="mt-4">
        <div class="px-3 pb-2 text-xs font-bold uppercase text-white/60 tracking-wider">Tienda</div>
        <a href="{{ route('admin.products') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.products') ? 'bg-white/20' : '' }}">
          <i class="fas fa-box fa-fw mr-3"></i>
          <span class="nav-text">Productos</span>
        </a>
        <a href="{{ route('admin.services.index') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.services.index') ? 'bg-white/20' : '' }}">
          <i class="fas fa-flask fa-fw mr-3"></i>
          <span class="nav-text">Servicios</span>
        </a>
        <a href="{{ route('admin.categories') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.categories') ? 'bg-white/20' : '' }}">
          <i class="fas fa-tags fa-fw mr-3"></i>
          <span class="nav-text">Categorías</span>
        </a>
        <a href="{{ route('admin.options') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.options*') ? 'bg-white/20' : '' }}">
          <i class="fas fa-cogs fa-fw mr-3"></i>
          <span class="nav-text">Opciones</span>
        </a>
        <a href="{{ route('admin.orders') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.orders') ? 'bg-white/20' : '' }}">
          <i class="fas fa-shopping-cart fa-fw mr-3"></i>
          <span class="nav-text">Ordenes</span>
        </a>
      </div>

      <div class="mt-4">
        <div class="px-3 pb-2 text-xs font-bold uppercase text-white/60 tracking-wider">Administración</div>
        <a href="{{ route('admin.users') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.users') ? 'bg-white/20' : '' }}">
          <i class="fas fa-users fa-fw mr-3"></i>
          <span class="nav-text">Usuarios</span>
        </a>
        <a href="{{ route('admin.notification_recipients.index') }}" 
           class="flex items-center px-3 py-2.5 rounded-md transition-colors duration-200 hover:bg-white/10 {{ request()->routeIs('admin.notification_recipients.index') ? 'bg-white/20' : '' }}">
          <i class="fas fa-envelope fa-fw mr-3"></i>
          <span class="nav-text">Recepción de Notificaciones</span>
        </a>
      </div>
    </nav>
  </div>
</div>
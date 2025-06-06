@extends('components.metadataHead')
@section('title', 'DurankMKT | Admin Dashboard')
@section('description', 'Pagina de administración DuranMkt')
@section('LayoutBody')

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('components.sidebar')

       
        <div class="content flex-1 overflow-auto">
            <!-- Header -->
            @include('components.header', ['headerTitle' => $headerTitle ?? 'Dashboard'])

            <!-- Contenido -->
            <main id="adminApp" class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"  defer></script>
    @yield('scripts')
   
   
     
@endsection
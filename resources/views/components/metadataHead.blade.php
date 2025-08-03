<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DuranMkt | Inicio')</title>
    <meta name="description" content="@yield('description', 'Somos una compañia enfocada en marketing digital basada en Nogales Sonora')">
    <meta name="keywords" content="@yield('keywords', 'Nogales, paginas web, marketing, diseño, personalización, marketing digital, grabado láser, uniformes bordados, puntos de venta')">
    <meta name="author" content="José Padilla">
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css') }} ">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="{{ url('https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/chart.js') }}"></script> 
    <link href="{{ url('https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @yield('styles')
</head>
<body class="bg-stone-200 text-gray-900">
    @yield('LayoutBody')





    @if (session('success') || session('error') || session('info') || $errors->any())+
         <x-global-alert-modal />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.dispatchEvent(new CustomEvent('show-modal', {
                detail: {
                    type: '{{ session('success') ? 'success' : (session('error') ? 'error' : 'info') }}',
                    @if ($errors->any())
                        type: 'error',
                        message: `<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>`
                    @else
                        message: `{!! session('success') ?? session('error') ?? session('info') !!}`
                    @endif
                }
            }));
        });
    </script>
    @endif
    @yield('scripts')
    
    
</body>
</html>
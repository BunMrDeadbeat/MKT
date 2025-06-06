<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DuranMkt | Inicio')</title>
    <meta name="description" content="@yield('description', 'Somos una compañia enfocada en marketing digital basada en Nogales Sonora')">
    <meta name="keywords" content="@yield('keywords', 'Nogales, paginas web, marketing, diseño, personalización, marketing digital, grabado láser, uniformes bordados, puntos de venta')">
    <meta name="author" content="José Padilla">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css'])
    @yield('styles')
</head>
<body class="bg-gray-100 text-gray-900">
    @yield('LayoutBody')
</body>

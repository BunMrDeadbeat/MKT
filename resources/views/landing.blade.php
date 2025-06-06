<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Somos una compañia de marketing digital basada en Nogales Sonora">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"
        content="Nogales, marketing, diseño, personalización, marketing digital, grabado láser, uniformes bordados, puntos de venta">
    <meta name="author" content="José Padilla">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>DuranMkt</title>
</head>

<body id="index">

    <main>
        <div>
        </div>
        <nav
            class="bg-green-600 p-4 shadow-lg hover:bg-indigo-950 hover:shadow-lime-500/50 duration-300 ease-in sticky top-0 z-50">
            <div class="container mx-auto flex justify-between items-center">
                <a href="#" class="text-white text-lg font-bold stroke-1 stroke-black">DuranMkt</a>
                <div id="menu-toggle" class="space-x-4">
                    <a href="#inicio" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"
                        class="text-gray-300 hover:text-white transition">Inicio</a>
                    <a href="#tienda" class="text-gray-300 hover:text-white transition">Tienda</a>
                </div>
            </div>
        </nav>
        <div class="bg-violet-950 min-h-screen p-8">

            <header>
                <h1 class="text-4xl sm:text-6xl font-extrabold text-center text-gray-200 mt-8">¡Hola, bienvenido!</h1>
            </header>
            <nav>
                <ul>
                    <li><a href="#services">Nuestros Servicios</a></li>
                    <li><a href="#contact">Contáctanos</a></li>
                </ul>
            </nav>
            <section id="services">
                <h2>Servicios</h2>
                <p>Publicidad para tu negocio, impresión, sublimación, grabado láser, uniformes bordados, y más.</p>
            </section>
            <footer>
                <p>Derechos Reservados © 2025</p>
            </footer>
        </div>

    </main>

    <script src="javascript/script.js"></script>
</body>

</html>
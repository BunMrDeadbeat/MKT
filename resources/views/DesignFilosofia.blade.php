<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Frutos de la fase de diseño')</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>

<body class="bg-beige text-gray-900 antialiased">
    <!-- Color de fondo BEIGE -->

    <body class="bg-[#f8e5cd] text-gray-900 antialiased">

        <!-- Contenido principal -->
        <div class="container mx-auto px-4 py-12">

            @section('title', 'Frutos de la fase de diseño')

            @section('content')
                <!-- HEADER -->
                <div class="max-w-md mx-auto mb-12 text-center">
                    <h1 class="text-4xl font-extrabold mb-4 text-gray-900">
                        Frutos de la fase de diseño
                    </h1>
                    <p class="text-lg text-gray-600 italic">
                        por Germán Padilla
                    </p>
                </div>

                <!-- El resto de tu contenido irá aquí -->
                <!-- SECCIÓN "LANDING PAGE" -->
                <section class="max-w-2xl mx-auto mb-16 px-6 py-8 bg-white rounded-lg shadow-lg">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            ¿Qué es una landing page optimizada?
                        </h2>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            La página web de DuranMKT debe contar con una página estática que funcione como un "faro",
                            atrayendo a
                            posibles clientes y mejorando de manera significativa el tráfico de la página. Una landing page
                            que cumpla
                            con el enfoque mencionado a continuación será altamente visible y priorizada por
                            los web
                            crawlers y algoritmos de búsqueda de diversos motores de busqueda.
                        </p>
                        <!-- PUNTOS DE OPTIMIZACIÓN -->
                        <div class="mt-8 space-y-6">
                            <!-- Punto 1: Meta Información -->
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    Meta Información:
                                </h3>
                                <p class="text-gray-600 text-base">
                                    A la nueva página se le debe añadir metatítulos y descripciones que no se encuentran en
                                    la página actual, lo
                                    que previene que sea encontrada por web crawlers y motores de búsqueda.
                                </p>
                            </div>

                            <!-- Punto 2: Estructura de Encabezados -->
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    Estructura de Encabezados:
                                </h3>
                                <p class="text-gray-600 text-base">
                                    La página actual carece de encabezados H1, elementos clave para definir la jerarquía del
                                    contenido y mejorar
                                    la optimización SEO, los cuales se implementarán en la nueva versión.
                                </p>
                            </div>

                            <!-- Punto 3: Contenido -->
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    Contenido:
                                </h3>
                                <p class="text-gray-600 text-base">
                                    La página actual tiene una cantidad insuficiente de texto en su código HTML, lo que
                                    afecta negativamente el
                                    SEO. La nueva landing page incluirá contenido adicional para ser mejor indexado por
                                    Google, Bing y otros
                                    motores.
                                </p>
                            </div>

                            <!-- Punto 4: Imágenes -->
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    Imágenes:
                                </h3>
                                <p class="text-gray-600 text-base">
                                    Las imágenes de la página actual carecen de atributos "alt", lo que impide su
                                    accesibilidad y su indexación
                                    por motores de búsqueda. Estos atributos se añadirán en la nueva versión.
                                </p>
                            </div>

                            <!-- Punto 5: Enlaces -->
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    Enlaces Internos y Externos:
                                </h3>
                                <p class="text-gray-600 text-base">
                                    La página actual tiene pocos enlaces internos o externos, lo que limita la navegación y
                                    reduce su autoridad
                                    de página (Page Authority). La nueva landing page incluirá más enlaces para mejorar su
                                    posicionamiento en
                                    los resultados de búsqueda.
                                </p>
                            </div>
                        </div>
                        <!-- NUEVO BLOQUE: Función de la landing page como portal -->
                        <div class="mt-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 text-center">
                                Función como portal hacia la aplicación
                            </h3>
                            <div class="text-gray-700 text-base leading-relaxed">
                                <p class="mb-4">
                                    Otro aspecto clave de la landing page es que será estática y actuará como portal o
                                    señalización para dirigir
                                    a los potenciales clientes hacia la sección de la tienda o aplicación web. Esto se debe
                                    a que el lado de la
                                    aplicación contendrá elementos dinámicos que utilizarán frameworks de JavaScript, lo
                                    cual no es beneficioso
                                    para el SEO ya que los web crawlers generalmente no cuentan con compatibilidad para ésta
                                    misma.
                                </p>
                                <p class="mb-4">
                                    Sin embargo, esto se puede mitigar completamente utilizando una landing page estática
                                    que dirija al cliente
                                    a la página web. La landing page estática garantizará que el contenido sea indexado
                                    correctamente por
                                    motores de búsqueda, mientras que la experiencia dinámica de la aplicación se mantendrá
                                    accesible mediante
                                    enlaces claros desde ésta página.
                                </p>
                            </div>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mt-16 mb-8 text-center">
                            Arquitectura del Sistema
                        </h2>
                        <!-- **Bloque 1: Modelos de datos** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                1. Modelos de datos
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                La estructura de datos se define mediante tres modelos clave que representan la información
                                de los productos y sus variantes:
                            </p>

                            <div class="bg-gray-800 text-white p-4 rounded-lg mb-4">
                                <!-- Esquema de modelos -->
                                <p class="text-gray-400 text-sm mb-2">
                                    <strong>Producto:</strong> Contiene nombre, descripción, precio, etc.
                                </p>
                                <p class="text-gray-400 text-sm mb-2">
                                    <strong>Opción:</strong> Relacionada con un producto (ej: colores).
                                </p>
                                <p class="text-gray-400 text-sm mb-2">
                                    <strong>Variante:</strong> Subcategoría de opciones (ej: tallas S, M, L).
                                </p>
                            </div>

                            <p class="text-gray-700 text-base mb-4">
                                **Relaciones:**
                                - Un <em>Producto</em> tiene muchas <em>Opciones</em>.
                                - Una <em>Opción</em> tiene muchas <em>Variante</em>s.
                            </p>
                        </div>

                        <!-- **Bloque 2: Base de datos** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                2. Base de datos
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Se crean tablas para almacenar los datos de productos, opciones y variantes, relacionadas
                                mediante llaves foráneas.
                            </p>

                            <div class="bg-gray-800 text-white p-4 rounded-lg mb-4">
                                <!-- Ejemplo de ruta dinámica -->
                                <p class="text-gray-400 text-sm mb-2">
                                    <strong>Ejemplo de ruta en <em>web.php</em>:</strong>
                                </p>
                                <code class="text-gray-300">
                                                                        Route::get('/producto/{slug}', [ProductoController::class, 'mostrar']);
                                                                    </code>
                            </div>

                            <p class="text-gray-700 text-base mb-4">
                                Cada nuevo producto genera una página única con la URL dinámica basada en su
                                <code>slug</code>.
                            </p>
                        </div>

                        <!-- **Bloque 3: Blade Templates** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                3. Blade Templates
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Plantillas para mostrar información de productos de manera estructurada.
                            </p>

                            <div class="bg-gray-800 text-white p-4 rounded-lg mb-4">
                                <!-- Ejemplo de Blade -->
                                <h3 class="text-gray-300">
                                    Pendiente a ver
                                    <img
                                        src="https://1.bp.blogspot.com/-sNMzt5B_434/UqRMeJqTFXI/AAAAAAAAWy8/S1HlRlOLQ2w/s1600/cute-puppy-298302.jpg">
                                </h3>
                            </div>
                        </div>

                        <!-- **Bloque 4: Panel de administración** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                4. Panel de administración
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Un panel administrativo con funcionalidades CRUD para gestionar productos y opciones.
                            </p>

                            <div class="bg-gray-800 text-white p-4 rounded-lg mb-4">
                                <!-- Ejemplo de validación -->
                                <p class="text-gray-400 text-sm mb-2">
                                    <strong>Ejemplo de validación en un controlador:</strong>
                                </p>
                                <code class="text-gray-300">
                                                                        $request-&gt;validate([<br>
                                                                            'nombre' =&gt; 'required|max:255',<br>
                                                                            'precio' =&gt; 'required|numeric',<br>
                                                                        ]);
                                                                    </code>
                            </div>

                            <p class="text-gray-700 text-base mb-4">
                                Se usa <em>Laravel React</em> o <em>Breeze</em> para implementar el panel.
                            </p>
                        </div>

                        <!-- **Bloque 5: Controladores** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                5. Controladores
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Métodos que gestionan la lógica empresarial, como crear o eliminar productos.
                            </p>

                            <p class="text-gray-700 text-base mb-4">
                                Ejemplo de acciones en <em>ProductoController</em>:
                                - <code>crearProducto()</code>
                                - <code>editarProducto()</code>
                                - <code>eliminarProducto()</code>
                            </p>
                        </div>

                        <!-- **Bloque 6: Interfaz de usuario (UI/UX)** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                6. Interfaz de usuario (UI/UX)
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Componentes clave para la experiencia del usuario:
                            </p>

                            <ul class="list-disc pl-6 text-gray-700 text-base mb-4">
                                <li>
                                    <strong>Página principal de la tienda:</strong> Lista de productos con imágenes y
                                    enlaces a sus páginas.
                                </li>
                                <li>
                                    <strong>Página de producto:</strong> Detalles completos, opciones y variantes
                                    disponibles.
                                </li>
                                <li>
                                    <strong>Carrito de compras y checkout:</strong> Integración con servicios como Stripe o
                                    PayPal.
                                </li>
                            </ul>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mt-16 mb-8 text-center">
                            FrameWork
                        </h2>
                        <!-- **Bloque 1: Laravel para e-commerce** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Laravel para e-commerce
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Laravel es una plataforma robusta y flexible diseñada para manejar complejos sistemas de
                                comercio electrónico:
                            </p>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Estructura Moderna y Flexible
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Laravel sigue el patrón MVC, garantizando una separación clara entre lógica empresarial,
                                    vistas y datos.
                                </p>
                                <p class="text-gray-600 text-base mb-2">
                                    Blade, su motor de plantillas, permite integrar interfaces dinámicas de manera sencilla.
                                </p>
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Manejo Dinámico de Datos
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Eloquent ORM simplifica la gestión de bases de datos, permitiendo manejar catálogos de
                                    productos, opciones y variantes con facilidad.
                                </p>
                                <p class="text-gray-600 text-base mb-2">
                                    Relaciones como <code>Producto &rarr; Opciones &rarr; Variantes</code> son intuitivas y
                                    mantenibles.
                                </p>
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Fácil Escalabilidad
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Laravel está diseñado para escalar desde tiendas pequeñas hasta marketplaces complejos.
                                </p>
                            </div>
                        </div>

                        <!-- **Bloque 2: Autenticación en Laravel** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Manejo de usuarios y autenticación
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Laravel incluye un sistema de autenticación robusto y seguro:
                            </p>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Sistema de Autenticación
                                </h4>
                                <ul class="list-disc pl-6 text-gray-600 text-base">
                                    <li>Registro e inicio de sesión seguro.</li>
                                    <li>Recuperación de contraseñas.</li>
                                    <li>Roles y permisos para distintos tipos de usuarios (ej: clientes, administradores).
                                    </li>
                                </ul>
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Seguridad Avanzada
                                </h4>
                                <ul class="list-disc pl-6 text-gray-600 text-base">
                                    <li><strong>Inyección SQL:</strong> Prevención mediante consultas preparadas en
                                        Eloquent.</li>
                                    <li><strong>XSS y CSRF:</strong> Protección con tokens y escape automático de datos en
                                        vistas.</li>
                                    <li><strong>Contraseñas cifradas:</strong> Usando bcrypt para almacenar datos de
                                        usuarios de manera segura.</li>
                                </ul>
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Autenticación API
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Laravel Sanctum permite autenticar usuarios con tokens para aplicaciones móviles o
                                    integraciones externas.
                                </p>
                            </div>
                        </div>

                        <!-- **Bloque 3: Tailwind CSS** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Tailwind CSS para diseño
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                Tailwind CSS ofrece un diseño moderno y consistente con clases utilitarias:
                            </p>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Estilo Moderno y Consistente
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Crea interfaces elegantes sin escribir CSS personalizado. Ejemplo:
                                </p>
                                <div class="bg-gray-800 text-white p-4 rounded-lg mb-4">
                                    <img
                                        src="https://th.bing.com/th/id/R.fb5a221489f004393abd8d448ef54f44?rik=l4pQCSIIlJNoXA&pid=ImgRaw&r=0">
                                </div>
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Componentes Reutilizables
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Crea componentes UI adaptables a distintos dispositivos, esencial para tiendas
                                    responsivas.
                                </p>
                            </div>
                        </div>

                        <!-- **Bloque 4: React.js** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                React.js para tareas gráficas y dinámicas
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                React.js complementa Laravel para desarrollar interacciones gráficas avanzadas:
                            </p>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Interacción con Usuarios
                                </h4>
                                <ul class="list-disc pl-6 text-gray-600 text-base">
                                    <li>Mockups para visualizar diseños en productos.</li>
                                    <li>Selectores de posiciones en imágenes para subir logotipos.</li>
                                </ul>
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Componentes Reactivos
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Ejemplo: Configuradores de productos donde los usuarios seleccionan colores, tamaños o
                                    suben diseños personalizados.
                                </p>
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                                <h4 class="text-xl font-bold text-blue-600 mb-2">
                                    Integración con Laravel
                                </h4>
                                <p class="text-gray-600 text-base mb-2">
                                    Laravel actúa como backend para manejar datos y autenticación, mientras React gestiona
                                    la interacción visual mediante APIs.
                                </p>
                            </div>
                        </div>

                        <!-- **Bloque 5: Beneficios combinados** -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Beneficios combinados para e-commerce
                            </h3>
                            <p class="text-gray-700 text-base mb-4">
                                La combinación de Laravel, React y Tailwind CSS permite:
                            </p>
                            <ul class="list-disc pl-6 text-gray-600 text-base">
                                <li><strong>Seguridad:</strong> Protección contra ataques y cifrado de datos.</li>
                                <li><strong>Funcionalidad:</strong> Backend robusto y frontend dinámico.</li>
                                <li><strong>Estética:</strong> Diseños modernos y responsivos.</li>
                            </ul>
                        </div>
                </section>
                <!-- CONCLUSIÓN -->
                <section class="max-w-2xl mx-auto mb-16 px-6 py-8 bg-white rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">
                        Conclusión
                    </h2>
                    <div class="text-gray-900 text-base leading-relaxed text-center">
                        La fase de diseño ha establecido una base sólida que garantiza la implementación eficiente de la
                        página web
                        final y su migración a un servidor en la nube (ej: Cloudflare). Gracias a esta estructura, el
                        desarrollo y
                        despliegue se realizarán con gran facilidad.

                        -German PAdilla
                    </div>
                </section>
            @endsection
            @yield('content')
        </div>

        @vite('resources/js/app.js')
    </body>

</html>
<!DOCTYPE html>
<html lang="en">
@extends('layouts.mainHeaderLayout')

<body id="index">

    @section('content')
     @if (session('error'))
                            <script>
                                alert("{{ session('error') }}");
                            </script>
                        @endif
        <div class="bg-mktPurple min-h-screen p-8">
            {{-- Heroe secion --}}
            <section id="inicio" class="banner-section rounded-3xl"
                style="background-image: url('https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')">
                <div class="banner-overlay absolute inset-0 "></div>
                <div class="relative max-w mx-auto bg-purple-900/70 rounded-3xl p-8">

                    <div class="flex flex-col md:flex-row items-center gap-12">

                        <div class="md:w-1/2 text-center md:text-left">
                            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Impulsa tu negocio con <span
                                    class="text-mktGreen">soluciones creativas</span></h1>
                            <p class="text-xl text-gray-200 mb-8">Más de 10,000 años ayudando a empresas en Nogales a
                                destacar con servicios de marketing digital y publicidad impresa.</p>
                            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                                <a href="#servicios"
                                    class="px-6 py-3 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold rounded-lg transition duration-300">
                                    Nuestros Servicios <i class="fas fa-arrow-down ml-2"></i>
                                </a>
                                <a href="#contacto"
                                    class="px-6 py-3 bg-white hover:bg-gray-100 text-mktPurple font-bold rounded-lg transition duration-300">
                                    Contáctanos <i class="fas fa-phone-alt ml-2"></i>
                                </a>
                                <a href="#contacto"
                                    class="px-6 py-3 bg-mktGreen hover:bg-gray-100 text-mktPurple font-bold rounded-lg transition duration-300">
                                    Tienda <i class="fas fa-store-alt ml-2"></i>
                                </a>
                            </div>

                        </div>
                        <div class="md:w-1/2 flex flex-col items-center">
                            <img class="w-120 mb-6" src="{{ url('/storage/images/logo.png') }}"
                                alt="Logo DuranMkt - Especialistas en marketing digital en Nogales">
                            <img class="w-120 h-120 object-cover "
                                src="{{ url('/storage/images/a91ad0a3299f5bd633b621ec3bafd0df.png') }}"
                                alt="Enrique Durán - Fundador de DuranMkt, experto en marketing digital en Nogales">
                        </div>
                    </div>
                </div>
            </section>

            <section id="servicios" class="mt-24 max-w-6xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-4">Servicios de <span
                            class="text-mktGreen">Publicidad</span></h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Soluciones integrales para promocionar tu marca y llegar a más clientes en Nogales
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.1s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Sublimación y grabado láser"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-tshirt"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Sublimación y grabado láser</h3>
                        <p class="text-gray-300">Personalización profesional de productos promocionales y regalos
                            corporativos.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                        </div>
                    </div>

                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.2s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Uniformes bordados"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-vest"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Uniformes bordados</h3>
                        <p class="text-gray-300">Camisas DTF, vinil de corte y bordados profesionales para tu equipo.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                             <a href="{{ route('products.show', 'unodos') }}" class="btn btn-primary">Ver Detalles</a>
                        </div>
                    </div>

                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.3s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Etiquetas y tarjetas"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Etiquetas y tarjetas</h3>
                        <p class="text-gray-300">Diseño e impresión profesional para presentar tu negocio con estilo.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                        </div>
                    </div>

                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.4s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Volantes y flyers"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-ad"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Volantes y flyers</h3>
                        <p class="text-gray-300">Diseños atractivos para campañas publicitarias tradicionales efectivas.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                        </div>
                    </div>

                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.5s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Software para Puntos de Venta"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-cash-register"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Software para Puntos de Venta</h3>
                        <p class="text-gray-300">Soluciones tecnológicas personalizadas según el tipo de negocio.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                        </div>
                    </div>

                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.6s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Cursos de capacitación"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Cursos de capacitación</h3>
                        <p class="text-gray-300">Ventas, servicio al cliente, marketing digital y más para tu equipo.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                        </div>
                    </div>

                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.7s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Diseño web"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Diseño web</h3>
                        <p class="text-gray-300">Landing pages, sitios corporativos y tiendas en línea profesionales.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                        </div>
                    </div>

                    <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.8s">
                        <img src="{{ url('/storage/images/users/padillagerman.jpg') }}" alt="Publicidad impresa"
                            class="w-full h-32 object-cover rounded-md mb-4">
                        <div class="text-yellow-300 text-3xl mb-4">
                            <i class="fas fa-print"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-2">Publicidad impresa</h3>
                        <p class="text-gray-300">Menús, lonas, anuncios 3D y material promocional de alta calidad.</p>
                        <div class="mt-4">
                            <span
                                class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde
                                $precioMin</span>
                        </div>
                    </div>
                </div>
            </section>


            <section id="impresion" class="mt-24 max-w-6xl mx-auto px-4">
                <div class="banner-section rounded-xl overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1605106702734-205df224ecce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80')">
                    <div class="banner-overlay "></div>
                    <div class="relative py-12 px-8  bg-indigo-700/80">
                        <div class="text-center mb-12">
                            <h2 class="text-4xl font-bold text-white mb-4">Servicios de <span class="text-mktGreen">Impresión</span></h2>
                            <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                                Calidad profesional en cada impresión para destacar tu negocio en Nogales
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Service Card 1 -->
                            <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.1s">
                                <div class="text-yellow-300 text-3xl mb-4 text-center">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-white mb-2 text-center">Menús y papelería</h3>
                                <p class="text-gray-300 text-center">Impresión de alta calidad para menús, flyers, recibos y toda la papelería que tu negocio necesita.</p>
                                <div class="mt-4 text-center">
                                    <span class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Paquetes desde $1,200</span>
                                </div>
                            </div>
                            
                            <!-- Service Card 2 -->
                            <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.3s">
                                <div class="text-yellow-300 text-3xl mb-4 text-center">
                                    <i class="fas fa-bullhorn"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-white mb-2 text-center">Publicidad exterior</h3>
                                <p class="text-gray-300 text-center">Anuncios 3D, lonas, vinil microperforado y soluciones visuales impactantes para llamar la atención.</p>
                                <div class="mt-4 text-center">
                                    <span class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Desde $2,500</span>
                                </div>
                            </div>
                            
                            <!-- Service Card 3 -->
                            <div class="service-card rounded-xl p-6 animate-fadeIn" style="animation-delay: 0.5s">
                                <div class="text-yellow-300 text-3xl mb-4 text-center">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-white mb-2 text-center">Branding corporativo</h3>
                                <p class="text-gray-300 text-center">Desarrollo de logotipos, identidad visual y estrategias de branding para posicionar tu marca.</p>
                                <div class="mt-4 text-center">
                                    <span class="inline-block bg-yellow-400 text-gray-900 px-3 py-1 text-sm font-semibold rounded-full">Paquetes desde $3,800</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="clientes" class="mt-16">
                <h2 class="text-3xl font-bold text-gray-200 mb-4">Clientes y Redes Sociales</h2>
                <p class="text-gray-400">Muestran su experiencia y logros, destacando a su fundador como empresario,
                    mercadólogo y conferencista.</p>
                <div class="mt-4">
                    <h3 class="text-xl font-semibold text-gray-300">Paquetes de manejo de redes sociales</h3>
                    <p class="text-gray-400">Publicación de contenido en Facebook, Instagram y TikTok.</p>
                    <ul class="list-disc list-inside text-gray-400">
                        <li>Desde $precioMin hasta $precioMin mensuales.</li>
                        <li>Incluyen sesiones de fotos y campañas publicitarias en Facebook Ads.</li>
                    </ul>
                </div>
            </section>

             <section id="contacto" class="mt-24 max-w-4xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-white mb-4">Contáctanos</h2>
                    <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                        Estamos listos para ayudarte a llevar tu negocio en Nogales al siguiente nivel
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="service-card rounded-xl p-8">
                        <h3 class="text-2xl font-bold text-white mb-6">Información de contacto</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="text-yellow-300 text-xl mt-1 mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-medium">Ubicación</h4>
                                    <p class="text-gray-300">Nogales, Sonora, México</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-yellow-300 text-xl mt-1 mr-4">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-medium">Teléfono</h4>
                                    <p class="text-gray-300">+52 631 123 4567</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-yellow-300 text-xl mt-1 mr-4">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-medium">Email</h4>
                                    <p class="text-gray-300">contacto@duranmkt.com</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="text-yellow-300 text-xl mt-1 mr-4">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-medium">Horario</h4>
                                    <p class="text-gray-300">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                                    <p class="text-gray-300">Sábados: 10:00 AM - 2:00 PM</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h4 class="text-white font-medium mb-4">Síguenos en redes sociales</h4>
                            <div class="flex space-x-4">
                                <a href="#" class="text-white hover:text-mktGreen text-2xl transition duration-300">
                                    <i class="fab fa-facebook">FACEBOOK PLACEHOLDER</i>
                                </a>
                                <a href="#" class="text-white hover:text-mktGreen text-2xl transition duration-300">
                                    <i class="fab fa-instagram">INSTA PLACEGHOLDER</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card rounded-xl p-8">
                        <h3 class="text-2xl font-bold text-white mb-6">Envíanos un mensaje</h3>
                        <form>
                            <div class="mb-4">
                                <label for="name" class="block text-white font-medium mb-2">Nombre completo</label>
                                <input type="text" id="name" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-white font-medium mb-2">Correo electrónico</label>
                                <input type="email" id="email" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="block text-white font-medium mb-2">Teléfono</label>
                                <input type="tel" id="phone" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                            </div>
                            <div class="mb-4">
                                <label for="service" class="block text-white font-medium mb-2">Servicio de interés</label>
                                <select id="service" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                    <option value="">Selecciona un servicio</option>
                                    <option value="sublimacion">Sublimación y grabado láser</option>
                                    <option value="uniformes">Uniformes bordados</option>
                                    <option value="diseño">Diseño web</option>
                                    <option value="redes">Manejo de redes sociales</option>
                                    <option value="impresion">Impresión publicitaria</option>
                                    <option value="cursos">Cursos de capacitación</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="block text-white font-medium mb-2">Mensaje</label>
                                <textarea id="message" rows="4" class="w-full bg-white bg-opacity-20 border border-white border-opacity-30 rounded-lg px-4 py-3 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-300"></textarea>
                            </div>
                            <button href="{{ route('login') }}" type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-4 rounded-lg transition duration-300">
                                Enviar mensaje PERO MANDA A AUTH PRIMERO <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    @endsection

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>

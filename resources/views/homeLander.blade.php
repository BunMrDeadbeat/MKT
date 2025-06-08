
@extends('layouts.mainHeaderLayout')


    @section('content')
         @if (session('error'))
                                <script>
                                    alert("{{ session('error') }}");
                                </script>
                            @endif
            <div class="bg-mktPurple min-h-3/4 p-8">
                {{-- Heroe secion --}}
                <section id="inicio" class="banner-section rounded-3xl"
                    style="
                    background-image: url('{{ asset('/storage/images/1053.png') }}');
                     background-color: rgba(0, 0, 0, 0.5);
                     background-blend-mode: overlay;
                     background-position: center;
                     background-repeat: no-repeat;
                     background-size: cover;
                    background-attachment: fixed;
                     background-position: center;
                      background-size:  auto;
                      background-repeat: repeat;">
                    <div class="banner-overlay absolute inset-0"></div>
                    <div class="relative max-w mx-auto bg-purple-900/60 rounded-3xl p-4">

                        <div class="flex flex-col md:flex-row items-center gap-12">


                            <div class="md:w-1/2 flex flex-col items-center">
                                <img loading="lazy" class="w-full mb-2" src="{{ url('/storage/images/logo.png') }}"
                                    alt="Logo DuranMkt - Especialistas en marketing digital en Nogales">
                                <img loading="lazy" class="w-full h-full"
                                    src="{{ url('/storage/images/a91ad0a3299f5bd633b621ec3bafd0df.png') }}"
                                    alt="Enrique Durán - Fundador de DuranMkt, filantropo, maestro, experto en marketing y negocios">
                            </div>
                            <div class="md:w-1/2 text-center md:text-left mb-3">
                                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Impulsa tu negocio con <span
                                        class="text-mktGreen">soluciones creativas</span></h1>
                                <p class="text-2xl text-gray-200 mb-8">Más de 10 años apoyando a empresas en Nogales a
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
                                    <a href="https://wa.me/+526313180029?text=Hola!%20Soy%20fan!!"
                                        class="px-6 py-3 bg-green-600 hover:bg-gray-100 text-mktPurple font-bold rounded-lg transition duration-300"
                                        target="_blank">
                                        WhatsApp <i class="fab fa-whatsapp font-bold ml-1"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

                @include('partials.lander.productCards')
                @include('partials.lander.impresion')
                @include('partials.lander.puntosVenta')
                @include('partials.lander.displayCursos')
                @include('partials.lander.webDev')
                @include('partials.lander.partners')


                @include('partials.lander.experience')
                @include('partials.lander.plans')

                 <section id="contacto" class="mt-24 max-w-4xl mx-auto px-4  rounded-2xl p-4">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-mktGreen mb-4">Contáctanos</h2>
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
                                        <p class="text-gray-300">Alvaro Obregon 4181, Nogales, Sonora, México</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="text-yellow-300 text-xl mt-1 mr-4">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-medium">Teléfono / WhatsApp</h4>
                                        <p class="text-gray-300">+52 631-126-0295</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="text-yellow-300 text-xl mt-1 mr-4">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-medium">Email</h4>
                                        <p class="text-gray-300">Durannogales@gmail.com</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="text-yellow-300 text-xl mt-1 mr-4">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-medium">Horario</h4>
                                        <p class="text-gray-300">Lunes a Sabado: 9:00 AM - 6:00 PM</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <h4 class="text-white font-medium mb-4">Síguenos en redes sociales</h4>
                                <div class="flex space-x-4">
                                    <a href="https://www.facebook.com/DuranMKT" class="text-blue-500 font-semibold hover:text-mktGreen text-2xl transition duration-300 ">
                                        <i class="fab fa-facebook"> FACEBOOK</i>
                                    </a>
                                    <a href="https://www.instagram.com/duran.mkt/" class="text-pink-500 text-2xl hover:text-amber-400 transition duration-300">
                                        <i class="fab fa-instagram"><span class="text-purple-700 hover:text-rose-500  transition duration-300"> INSTAGRAM</span></i>
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


                @include('partials.lander.gstop')
            </div>
            
    @endsection
@section('scripts')
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
    @endsection



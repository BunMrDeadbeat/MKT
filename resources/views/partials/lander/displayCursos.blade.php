<section class="relative py-16 px-6 mt-12 bg-gradient-to-br from-purple-700 to-indigo-800 border-4 border-purple-400 rounded-3xl max-w-6xl mx-auto overflow-hidden shadow-2xl" aria-labelledby="courses-title">
    <div class="absolute inset-0 z-0">
        <div loading="lazy" class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('{{ asset('storage/images/education.webp') }}');
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed;"></div> {{-- Replace with a relevant background image --}}
        <div class="absolute inset-0 bg-black opacity-40"></div> </div>

    <div class="relative z-10 max-w-7xl mx-auto text-white text-center">
        <h2 id="courses-title" class="text-5xl md:text-6xl font-extrabold mb-12 text-mktGreen drop-shadow-lg leading-tight">
            CURSOS
        </h2>
        <h3 class="text-3xl md:text-4xl font-semibold my-8 drop-shadow-lg">
            Aprende y crece con nuestros cursos especializados impartidos por el MDM Enrique Durán.
        </h3>
        <div class="grid md:grid-cols-3 gap-10">
            {{-- Marketing Digital Section --}}
            <div class="bg-white/10 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-purple-300 transform transition duration-500 hover:scale-105 hover:bg-white/20">
                <h3 class="text-2xl font-bold text-purple-200 mb-4 drop-shadow">MARKETING DIGITAL</h3>
                <div class="relative w-full h-48 mb-6 rounded-lg overflow-hidden shadow-md">
                    <img  loading="lazy" src="{{ asset('storage/images/marketing-digital.webp') }}" alt="Marketing Digital Course" class="w-full h-full object-cover">
                    <div class="absolute inset-0 from-black to-indigo-200 bg-opacity-80 flex items-center justify-center p-4">
                       
                    </div>
                </div>
                <ul class="text-left space-y-3 text-purple-100">
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>CAMPAÑAS PUBLICITARIAS</p></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>CANVA CON INTELIGENCIA ARTIFICIAL</p></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>HERRAMIENTAS DIGITALES EDUCATIVAS</p></li>
                </ul>
            </div>

            {{-- Servicio al Cliente Section --}}
            <div class="bg-white/10 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-purple-300 transform transition duration-500 hover:scale-105 hover:bg-white/20">
                <h3 class="text-2xl font-bold text-purple-200 mb-4 drop-shadow">SERVICIO AL CLIENTE</h3>
                <div class="relative w-full h-48 mb-6 rounded-lg overflow-hidden shadow-md">
                    <img loading="lazy" src="{{ asset('storage/images/customer-service.webp') }}" alt="Customer Service Course" class="w-full h-full object-cover">
                    <div class="absolute inset-0 from-black to-indigo-200 bg-opacity-50 flex items-center justify-center p-4">
                        
                    </div>
                </div>
                <ul class="text-left space-y-3 text-purple-100">
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>GESTIÓN DE QUEJAS</p></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>TRABAJO EN EQUIPO</p></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>LIDERAZGO</p></li>
                </ul>
            </div>

            {{-- Ventas Section --}}
            <div class="bg-white/10 backdrop-blur-sm rounded-xl shadow-lg p-6 border border-purple-300 transform transition duration-500 hover:scale-105 hover:bg-white/20">
                <h3 class="text-2xl font-bold text-purple-200 mb-4 drop-shadow">VENTAS</h3>
                <div class="relative w-full h-48 mb-6 rounded-lg overflow-hidden shadow-md">
                    <img loading="lazy" src="{{ asset('storage/images/sales.webp') }}" alt="Sales Course" class="w-full h-full object-cover">
                    <div class="absolute inset-0 from-black to-indigo-200 bg-opacity-50 flex items-center justify-center p-4">
                       
                    </div>
                </div>
                <ul class="text-left space-y-3 text-purple-100">
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>VENTAS EN LA ERA DIGITAL</p></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>ESTRATEGIAS COMERCIALES</p></li>
                    <li class="flex items-start"><i class="fas fa-check-circle text-purple-300 mr-3 mt-1"></i><p>MERCHANDISING</p></li>
                </ul>
            </div>
        </div>
    </div>
</section>
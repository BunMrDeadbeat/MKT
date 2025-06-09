<section id="planes-marketing" class="mt-12 max-w-6xl mx-auto px-4">
    <div class="banner-section rounded-xl overflow-hidden" style="background-image: url('{{ asset('/storage/images/social-media-bg.webp') }}');
                                          background-blend-mode: overlay;
                                          background-position: center;
                                          background-repeat: repeat;
                                          background-size: 30%;
                                          background-attachment: fixed;
                                          background-position: center;">
        <div class="relative py-12 px-8 bg-purple-800/80">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">Planes de <span class="text-mktGreen">Marketing Digital</span></h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Impulsa tu presencia online en la Heroica Nogales, con nuestros excelentes paquetes de redes sociales diseñados para tu negocio.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Paquete FACEBOOK --}}
                 <div class="marketing-card rounded-xl p-6 bg-white/10 backdrop-blur-sm animate-fadeIn" style="animation-delay: 0.1s">

                    <div class="flex-shrink-0 h-24 w-24 bg-violet-100 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fab fa-facebook-f text-4xl"></i> {{-- Icono de Facebook más grande --}}
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2 text-center">PAQUETE FACEBOOK</h3>
                    <p class="text-gray-300 text-center mb-4">
                        20 publicaciones en Facebook y una sesión de fotos.
                        Un 25% de la inversión se destina a campañas publicitarias en Facebook Ads.
                    </p>
                    <div class="mt-auto text-center">
                        <span class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 text-lg font-bold rounded-full">$6000 Mensual</span>
                    </div>
                </div>

                {{-- Paquete META --}}
                  <div class="marketing-card rounded-xl p-6 bg-white/10 backdrop-blur-sm animate-fadeIn" style="animation-delay: 0.3s">
                    {{-- Icono de Meta (Facebook/Instagram) --}}
                    <div class="flex-shrink-0 h-24 w-24 bg-violet-100 text-blue-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fab fa-meta text-4xl"></i> {{-- Icono de Meta más grande --}}
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2 text-center">PAQUETE META</h3>
                    <p class="text-gray-300 text-center mb-4">
                        20 publicaciones en Facebook e Instagram y una sesión de fotos.
                        Un 25% de la inversión se destina a campañas publicitarias en Facebook Ads.
                    </p>
                    <div class="mt-auto text-center">
                        <span class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 text-lg font-bold rounded-full">$9000 Mensual</span>
                    </div>
                </div>

                {{-- Paquete PRO --}}
                <div class="marketing-card rounded-xl p-6 bg-white/10 backdrop-blur-sm animate-fadeIn" style="animation-delay: 0.5s">
                    {{-- Icono de Redes Sociales (genérico para PRO) --}}
                    <div class="flex-shrink-0 h-24 w-24 bg-violet-100 text-cyan-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-share-alt text-4xl"></i> {{-- Icono genérico de compartir (redes sociales) más grande --}}
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2 text-center">PAQUETE PRO</h3>
                    <p class="text-gray-300 text-center mb-4">
                        20 publicaciones en Facebook, Instagram y TikTok, y una sesión de fotos.
                        Un 25% de la inversión se destina a campañas publicitarias en Facebook Ads.
                    </p>
                    <div class="mt-auto text-center">
                        <span class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 text-lg font-bold rounded-full">$12000 Mensual</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
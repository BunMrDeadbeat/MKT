<section id="servicios" class="mt-12 max-w-12xl mx-auto px-6">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-white mb-4">Servicios de <span
                                class="text-mktGreen">Publicidad</span></h2>
                        <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                            Soluciones integrales para promocionar tu marca y llegar a más clientes en Nogales
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                        @if ($product->status=='active')
            
        
                        <x-lander.serviceCard 
                            :image="$product->galleries->first()->image" 
                            :title="$product->name" 
                            :description="$product->description"
                            :productSlug="$product->slug" 
                            animationDelay="0.2s" />
                            @endif
                    @endforeach
                    </div>
                </section>
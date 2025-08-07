<div class="flex flex-wrap p-5 m-5 gap-6 justify-center">
    @foreach($productos as $product)

                    @php
                $featuredGallery = $product->galleries->firstWhere('is_featured', 1);
                    @endphp
                    @if ($featuredGallery && $featuredGallery->image && $product->status === 'active')
                        <div class="bg-white rounded-lg  overflow-hidden hover:shadow-lg transition-all w-full sm:w-60 flex-shrink-0 h-120 flex flex-col shadow-lg shadow-neutral-800">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <div class="h-60 bg-gray-200 overflow-hidden flex items-center justify-center">
                                    <img src="{{ asset('storage/'.$featuredGallery->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
                                </div>



                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $product->name }}</h3>
                                         @if ($product->price && $product->type === 'product' && $product->price > 0)
                                             @if ($product->options->wherein('id', 11)->isNotEmpty())
                                                <div class="flex justify-between items-center m-2">
                                                    <span class="text-primary font-bold">${{ $product->price }}</span>
                                                </div>
                                            @else
                                                    <div class=" m-2">
                                                         <span class="text-primary font-bold">Cotización disponible!</span>
                                                        <span class="text-sm"> Empezando desde</span> <span class=" text-emerald-800 font-semibold text-md">${{ $product->price }}</span>
                                                    </div>
                                            @endif

                                        @elseif ($product->price>0)
                                        <div class="flex justify-between items-center m-2">
                                            <span class="text-primary font-bold">¡Disponible por <span class="text-mktGreen">${{ $product->price }}</span>!</span>
                                        </div>
                                        @else
                                        <div class="flex justify-between items-center m-2">
                                            <span class="text-primary font-bold">Cotización disponible!</span>
                                        </div>
                                    @endif
                                    <p class="text-mktGreen/70 text-sm mb-2">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </p>

                                    <div class="mb-3 max-h-32 overflow-hidden relative">
                                        <div class="quill-content text-sm text-gray-600">
                                            {!! $product->description !!}
                                        </div>

                                    </div>

                                </div>
                            </a>
                        </div>
                    @endif
    @endforeach
</div>

    <div class="pagination-container mt-8 from-beige to-mktPurple bg-gradient-to-b p-4 shadow-md">
        {{ $productos->links() }}
    </div>
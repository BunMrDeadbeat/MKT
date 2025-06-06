<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($productos as $product)
                        @php
                            {{ $featuredGallery = $product->galleries->firstWhere('is_featured', 1);}}
                        @endphp
                        @if ($featuredGallery&&$featuredGallery->image&&($product->status=='active'))
                            <div class="product-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all">
                            <a href="{{ route('products.show', $product->id) }}">
                                <div class="h-48 bg-gray-200 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $featuredGallery->image)}}" alt="{{ $product->name }}" class="max-h-full max-w-full">
                                            
                                </div>
                             <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600">Categoria: {{ $product->category->name ?? 'Uncategorized' }}</p>
                            <p class="text-sm text-gray-600">{{ $product->description ? Str::limit($product->description, 100) : 'No description available' }}</p>
                            @if ($product->price&&($product->type=='product'))
                                <div class="flex justify-between items-center mt-2">
                                    <span class="text-primary font-bold">${{ $product->price }}</span>
                                </div>
                            @endif
                        </div>
                            </a>
                        </div>
                        @endif
                                    
                    @endforeach
                </div>
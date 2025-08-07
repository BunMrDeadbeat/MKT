@extends('layouts.storeLayout')
    @section('content')
        <!-- Hero Section -->
        
        <section id="hero-section" class="bg-gradient-to-r from-primary to-mktPurple text-white py-16 transition-all duration-500 bg-cover bg-center ">
    <div class="container mx-auto px-4 text-center ">
        <h2 id="hero-title" class="text-4xl md:text-5xl font-bold mb-4">Soluciones Impresas y Digitales para Tu Negocio</h2>
        <p id="hero-description" class="text-xl md:text-2xl mb-8 text-shadow-lg/50 text-shadow-black z-auto">Impulsa tu presencia con nuestros productos y servicios</p>
        <p id="hero-description-2" class="text-md md:text-xl mb-8 text-shadow-lg/50 text-shadow-black z-auto">Seleccióne una categoría para filtrar las opciones:</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#"
                   class="
                       category-card
                       h-40
                       rounded-lg
                       bg-cover
                       bg-center
                       flex
                       items-end
                       p-4
                       shadow-lg
                       hover:shadow-xl
                       transition-all
                       duration-300 transform
                       hover:-translate-y-2
                   "
                   data-category-id="0",
                   data-category-image-url="/storage/images/mktPlace.png"
                   data-category-name="El alcance completo de nuestra empresa."
                   style="background-image: linear-gradient(to top, rgba(0,0,0,10), transparent), url('/storage/images/MARKETING-DIGITAL.WEBP')"
                   data-category-description="Una vista amplia a todos nuestros productos y servicios"> 
                    <div>
                        <h3 class="text-white text-xl font-bold capitalize">Todos</h3>
                    </div>
                </a>
            @foreach($categorias as $category)
                <a href="#"
                   class="
                       category-card
                       h-40
                       rounded-lg
                       bg-cover
                       bg-center
                       flex
                       items-end
                       p-4
                       shadow-lg
                       hover:shadow-xl
                       transition-all
                       duration-300 transform
                       hover:-translate-y-2
                   "
                   style="background-image: linear-gradient(to top, rgba(0,0,0,0.7), transparent), url('/storage/{{$category->main_picture}}')"
                   data-category-id="{{ $category->id }}"
                   data-category-name="{{ $category->name }}"
                   data-category-image-url="/storage/{{$category->big_picture }}" 
                   data-category-description="{{ $category->description ?? 'No hay descripción disponible para esta categoría.' }}"> 
                    <div>
                        <h3 class="text-white text-xl font-bold capitalize">{{ $category->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

 
         <section class="products-section" style="background-image: url('/storage/images/tienda.webp'); background-size: 45%; md:background-size: 15%; background-repeat: repeat; background-attachment: fixed;" >
                <h2 class="text-3xl font-bold mb-6 text-stone-200 px-3 pb-5 pt-3 from-slate-900/80 to-emerald-300/10 bg-gradient-to-br   ">Nuestros Productos</h2>
                <div id="products-container">
                @include('partials.tienda.listaProductos', ['productos' => $productos])
                </div>

            </section> 
    @endsection


@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroSection = document.getElementById('hero-section');
        const heroTitle = document.getElementById('hero-title');
        const heroDescription = document.getElementById('hero-description');
        const categoryCards = document.querySelectorAll('.category-card');
        const productsContainer = document.getElementById('products-container');

        function loadProducts(url) {
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La respuesta de la red no fue correcta.');
                    }
                    return response.text();
                })
                .then(html => {
                    productsContainer.innerHTML = html;
                    productsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                })
                .catch(error => {
                    console.error('Error al cargar los productos:', error);
                    productsContainer.innerHTML = '<p class="text-center text-red-500">Hubo un error al cargar el contenido.</p>';
                });
        }

        categoryCards.forEach(card => {
            card.addEventListener('click', function(event) {
                event.preventDefault();

                const categoryId = this.dataset.categoryId;
                const categoryName = this.dataset.categoryName;
                const categoryImageUrl = this.dataset.categoryImageUrl;
                const categoryDescription = this.dataset.categoryDescription;

                heroSection.style.backgroundImage = `linear-gradient(to top, rgba(0,0,0,0.9), transparent), url('${categoryImageUrl}')`;
                heroTitle.textContent = categoryName;
                heroDescription.textContent = categoryDescription;
                
                loadProducts(`/products/filter/${categoryId}`);
            });
        });

        productsContainer.addEventListener('click', function(event) {
            const paginationLink = event.target.closest('.pagination-container a');

            if (paginationLink) {
                event.preventDefault();
                const url = paginationLink.href;
                if (url) {
                    loadProducts(url);
                }
            }
        });
    });
</script>
@endsection
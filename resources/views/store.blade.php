@extends('layouts.storeLayout')
    @section('content')
        <!-- Hero Section -->
        <section id="hero-section" class="bg-gradient-to-r from-primary to-mktPurple text-white py-16 transition-all duration-500 bg-cover bg-center">
    <div class="container mx-auto px-4 text-center ">
        <h2 id="hero-title" class="text-4xl md:text-5xl font-bold mb-4">Soluciones Impresas y Digitales para Tu Negocio</h2>
        <p id="hero-description" class="text-xl md:text-2xl mb-8 text-shadow-lg/50 text-shadow-black z-auto">Impulsa tu presencia con nuestros productos y servicios</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
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
                   style="background-image: linear-gradient(to top, rgba(0,0,0,0.7), transparent), url('/storage/images/{{$category->name}}.jpg')"
                   data-category-id="{{ $category->id }}"
                   data-category-name="{{ $category->name }}"
                   data-category-image-url="/storage/images/{{ Str::slug($category->name) }}.jpg" {{-- Usamos Str::slug para URL --}}
                   data-category-description="{{ $category->description ?? 'No hay descripción disponible para esta categoría.' }}"> {{-- Asegúrate de tener una descripción en tu modelo de categoría --}}
                    <div>
                        <h3 class="text-white text-xl font-bold capitalize">{{ $category->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

 
         <section class="products-section my-12 mx-5">
                <h2 class="text-3xl font-bold mb-6 text-primary">Nuestros Productos</h2>
                <div id="products-container">
                @include('partials.tienda.listaProductos', ['productos' => $productos])
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $productos->links() }}
                </div>
            </section>
    @endsection

</html>
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heroSection = document.getElementById('hero-section');
        const heroTitle = document.getElementById('hero-title');
        const heroDescription = document.getElementById('hero-description');
        const categoryCards = document.querySelectorAll('.category-card');

        // Almacenar los valores originales para restaurar si es necesario
        const originalHeroTitle = heroTitle.textContent;
        const originalHeroDescription = heroDescription.textContent;
        const originalHeroBackgroundClass = heroSection.className; // Captura todas las clases incluyendo el gradiente


        categoryCards.forEach(card => {
            card.addEventListener('click', function(event) {
                event.preventDefault(); // Evita que la página se recargue al hacer clic en el <a>

                    const categoryId = this.dataset.categoryId;
                const categoryName = this.dataset.categoryName;
                const categoryImageUrl = this.dataset.categoryImageUrl;
                const categoryDescription = this.dataset.categoryDescription || categoryDescriptions[categoryName.toLowerCase()]; // Usa la del data-attribute o el objeto local

                // 1. Reemplazar el fondo de la hero section
                // Removemos las clases de gradiente y agregamos la imagen
                //heroSection.classList.remove('from-primary', 'to-mktPurple', 'bg-gradient-to-r');
                heroSection.style.backgroundImage = `linear-gradient(to top, rgba(0,0,0,0.9), transparent), url('${categoryImageUrl}')`;

                // 2. Reemplazar el texto del h2
                heroTitle.textContent = categoryName;

                // 3. Reemplazar el texto del p
                heroDescription.textContent = categoryDescription;
                fetch(`/products/filter/${categoryId}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('products-container').innerHTML = html;
                    })
                    .catch(error => console.error('Error al filtrar productos:', error));
            });
        });

        // Opcional: Función para restaurar la sección hero a su estado original
        // Podrías llamarla si añades un botón de "Restaurar" o un temporizador
        // function restoreHeroSection() {
        //     heroSection.className = originalHeroBackgroundClass; // Restaura las clases originales
        //     heroSection.style.backgroundImage = ''; // Elimina el estilo de imagen de fondo
        //     heroTitle.textContent = originalHeroTitle;
        //     heroDescription.textContent = originalHeroDescription;
        // }
    });
</script>
@endsection
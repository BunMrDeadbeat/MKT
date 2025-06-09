
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productsModal');
    const categoryNameSpan = document.getElementById('categoryName');
    const productsList = document.getElementById('productsList');
    const closeModalBtn = document.getElementById('closeModalButton');

    // Escuchar clickl
    document.querySelectorAll('.open-products-modal').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const categoryId = this.getAttribute('data-category-id');
            const categoryName = this.getAttribute('data-category-name');

            productsList.innerHTML = '';

            // Buscar products
        array.forEach($categore => {
            
        });

    const products = categoryProducts[categoryId] || [];

    if (products.length > 0) {
        products.forEach(product => {
            const li = document.createElement('li');
            li.textContent = `ID ${product.id}: ${product.name}`;
            productsList.appendChild(li);
        });
    } else {
        const li = document.createElement('li');
        li.textContent = 'No hay productos en esta categoría.';
        li.classList.add('text-gray-500');
        productsList.appendChild(li);
    }

    categoryNameSpan.textContent = categoryName;
    modal.classList.remove('hidden');
});
        });

// Cerrar modal
closeModalBtn.addEventListener('click', function () {
    modal.classList.add('hidden');
});

// Opcional: cerrar al hacer clic fuera
document.querySelector('#productsModal .bg-gray-500').addEventListener('click', function () {
    modal.classList.add('hidden');
});
    });

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');




document.addEventListener('click', function (event) {
    // Use event delegation to catch clicks on buttons, even if they are added later
    if (!event.target.closest('.remove-from-cart-btn')) {
        return;
    }
    event.preventDefault();

    const removeButton = event.target.closest('.remove-from-cart-btn');
    const itemElement = removeButton.closest('.cart-item');
    const itemId = itemElement.dataset.itemId;


    fetch(`/carrito/items/${itemId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                itemElement.style.animation = 'fadeIn 0.3s ease-out reverse';
                setTimeout(() => {
                    itemElement.remove();

                    const countElement = document.getElementById('cart-item-count');
                    const subtotalElement = document.getElementById('cart-subtotal');

                    if (countElement) {
                        countElement.textContent = data.newCount;
                    }
                    if (subtotalElement) {
                        subtotalElement.textContent = '$' + data.newSubtotal;
                    }

                    // 3. Handle the case where the cart is now empty
                    if (data.newCount === 0) {
                        const cartBody = document.getElementById('cart-body');
                        const cartFooter = document.getElementById('cart-footer');

                        if (cartFooter) {
                            cartFooter.classList.add('hidden');
                        }

                        // Display the "empty cart" message
                        if (cartBody && !document.getElementById('empty-cart-message')) {
                            const emptyMessage = `
                            <div id="empty-cart-message" class="p-6 text-center text-gray-500">
                                Tu carrito está vacío.
                            </div>`;
                            document.querySelector('.cart-items-container').innerHTML = emptyMessage;
                        }
                    }

                }, 300); // Wait for animation to finish
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to remove item.');
        });
});
document.querySelectorAll('.options-toggle').forEach(button => {
    button.addEventListener('click', function (e) {
        e.stopPropagation();
        const dropdown = this.nextElementSibling;
        document.querySelectorAll('.options-dropdown').forEach(d => {
            if (d !== dropdown) d.classList.add('hidden');
        });
        dropdown.classList.toggle('hidden');
    });
});

document.body.addEventListener('click', (event) => {
    const button = event.target.closest('.quantity-btn');
    if (!button) return;

    const itemElement = button.closest('.cart-item');
    const itemId = itemElement.dataset.itemId;
    const input = itemElement.querySelector('.quantity-input');
    let currentQuantity = parseInt(input.value, 10);

    const action = button.dataset.action;
    if (action === 'increase') {
        currentQuantity++;
    } else if (action === 'decrease' && currentQuantity > 1) {
        currentQuantity--;
    }

    input.value = currentQuantity; // Actualiza el valor visualmente de inmediato
    updateCartQuantity(itemId, currentQuantity);
});

document.body.addEventListener('change', (event) => {
    const input = event.target;
    if (!input.classList.contains('quantity-input')) return;

    const itemElement = input.closest('.cart-item');
    const itemId = itemElement.dataset.itemId;
    let newQuantity = parseInt(input.value, 10);

    // Asegura que la cantidad no sea menor que 1
    if (isNaN(newQuantity) || newQuantity < 1) {
        newQuantity = 1;
        input.value = newQuantity;
    }

    updateCartQuantity(itemId, newQuantity);
});
async function updateCartQuantity(itemId, newQuantity) {
        try {
            const response = await fetch(`/carrito/items/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    quantity: newQuantity
                })
            });

            if (!response.ok) {
                throw new Error('Error de actualización del carrito');
            }

            const data = await response.json();

            if (data.success) {
                // Actualiza los totales del carrito en la UI
                document.getElementById('cart-item-count').textContent = data.newCount;
                document.getElementById('cart-subtotal').textContent = '$' + data.newSubtotal;
                // Opcional: Actualizar el precio de este ítem específico si lo muestras
                // document.querySelector(`[data-item-id="${itemId}"] .item-total-price`).textContent = '$' + data.newItemPrice;
            } else {
                 // Si hay errores de validación, los muestra.
                 console.error('Validation errors:', data.errors);
                 // Podrías revertir el valor del input al original aquí.
            }

        } catch (error) {
            console.error('Failed to update quantity:', error);
        }
    }
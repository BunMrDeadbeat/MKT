// const { Session } = require("inspector/promises");
/**
 * Muestra una notificación toast personalizada en la pantalla.
 * @param {string} message - El mensaje que se mostrará en la alerta.
 * @param {string} [type='info'] - El tipo de alerta ('success', 'error', o 'info').
 */
function showAlert(message, type = 'info') {
    // 1. Crear el contenedor principal de la alerta
    const alertWrapper = document.createElement('div');

    // 2. Definir estilos y el ícono según el tipo de alerta
    let bgColor, icon;
    switch (type) {
        case 'success':
            bgColor = 'bg-green-600';
            icon = `<svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
            break;
        case 'error':
            bgColor = 'bg-red-600';
            icon = `<svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
            break;
        default: // 'info'
            bgColor = 'bg-blue-600';
            icon = `<svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
            break;
    }

    // 3. Aplicar clases para estilos y animación
    alertWrapper.className = `fixed top-5 right-5 max-w-sm w-full p-4 rounded-lg shadow-2xl text-white transform transition-all duration-300 ease-in-out z-50 ${bgColor} translate-x-full`;
    alertWrapper.innerHTML = `
        <div class="flex items-center">
            ${icon}
            <span>${message}</span>
        </div>
    `;

    // 4. Añadir la alerta al cuerpo del documento
    document.body.appendChild(alertWrapper);

    // 5. Animar la entrada de la alerta
    setTimeout(() => {
        alertWrapper.classList.remove('translate-x-full');
    }, 10);

    // 6. Programar la eliminación de la alerta
    setTimeout(() => {
        alertWrapper.classList.add('translate-x-full');
        alertWrapper.addEventListener('transitionend', () => alertWrapper.remove());
    }, 4000); // La alerta dura 4 segundos
}

document.addEventListener('DOMContentLoaded', function () {
    // La función showAlert(message, type) debe estar definida aquí arriba.

    const confirmOrderBtn = document.getElementById('confirm-order-btn');

    if (confirmOrderBtn) {
        const buttonText = document.getElementById('button-text');
        const loadingSpinner = document.getElementById('loading-spinner');

        confirmOrderBtn.addEventListener('click', function () {
            // --- Validación con las nuevas alertas ---
            const selectedItems = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
            if (selectedItems.length === 0) {
                showAlert('Por favor, selecciona al menos un artículo.', 'error');
                return;
            }

            const paymentMethodInput = document.querySelector('input[name="payment_method"]:checked');
            if (!paymentMethodInput) {
                showAlert('Por favor, selecciona un método de pago.', 'error');
                return;
            }

            const notificationMethodInputs = document.querySelectorAll('input[name="notification_methods[]"]:checked');
            if (notificationMethodInputs.length === 0) {
                showAlert('Por favor, selecciona un medio de notificación.', 'error');
                return;
            }

            const paymentMethod = paymentMethodInput.value;
            const notificationMethods = Array.from(notificationMethodInputs).map(checkbox => checkbox.value);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // --- Lógica del botón de carga ---
            confirmOrderBtn.disabled = true;
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');

            // --- Llamada Fetch con nuevas alertas ---
            fetch('/solicitud/crear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    item_ids: selectedItems,
                    payment_method: paymentMethod,
                    notification_methods: notificationMethods
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('¡Solicitud creada con éxito!, se envió un correo de confirmación. Revisa tu spam si no lo ves.', 'success');
                    // Esperamos un momento para que el usuario vea la alerta antes de recargar
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                } else {
                    showAlert('Error: ' + data.message, 'error');
                    // Reactivar el botón si hay un error
                    confirmOrderBtn.disabled = false;
                    buttonText.classList.remove('hidden');
                    loadingSpinner.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Ocurrió un error inesperado al procesar la solicitud.', 'error');
                // Reactivar el botón si hay un error
                confirmOrderBtn.disabled = false;
                buttonText.classList.remove('hidden');
                loadingSpinner.classList.add('hidden');
            });
        });
    }
    
    // ... (el resto de tu código para el carrito, etc. permanece igual)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.remove-from-cart-btn')) return;
        event.preventDefault();

        const removeButton = event.target.closest('.remove-from-cart-btn');
        const itemElement = removeButton.closest('.cart-item');
        const itemId = itemElement.dataset.itemId;

        fetch(`/carrito/items/${itemId}`, {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('Artículo eliminado del carrito.', 'success'); // ✨ Alerta mejorada
                itemElement.style.animation = 'fadeIn 0.3s ease-out reverse';
                setTimeout(() => {
                    itemElement.remove();
                    const countElement = document.getElementById('cart-item-count');
                    const subtotalElement = document.getElementById('cart-subtotal');
                    if (countElement) countElement.textContent = data.newCount;
                    if (subtotalElement) subtotalElement.textContent = '$' + data.newSubtotal;
                    if (data.newCount === 0) {
                        const cartBody = document.getElementById('cart-body');
                        const cartFooter = document.getElementById('cart-footer');
                        if (cartFooter) cartFooter.classList.add('hidden');
                        if (cartBody && !document.getElementById('empty-cart-message')) {
                            document.querySelector('.cart-items-container').innerHTML = `
                            <div id="empty-cart-message" class="p-6 text-center text-gray-500">
                                Tu carrito está vacío.
                            </div>`;
                        }
                    }
                }, 300);
            } else {
                showAlert(data.message || 'No se pudo eliminar el artículo.', 'error'); // ✨ Alerta mejorada
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Ocurrió un error al eliminar el artículo.', 'error'); // ✨ Alerta mejorada
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
        if (action === 'increase') currentQuantity++;
        else if (action === 'decrease' && currentQuantity > 1) currentQuantity--;
        input.value = currentQuantity;
        updateCartQuantity(itemId, currentQuantity);
    });

    document.body.addEventListener('change', (event) => {
        const input = event.target;
        if (!input.classList.contains('quantity-input')) return;
        const itemElement = input.closest('.cart-item');
        const itemId = itemElement.dataset.itemId;
        let newQuantity = parseInt(input.value, 10);
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
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ quantity: newQuantity })
            });
            if (!response.ok) throw new Error('Error de actualización del carrito');
            const data = await response.json();
            if (data.success) {
                document.getElementById('cart-item-count').textContent = data.newCount;
                document.getElementById('cart-subtotal').textContent = '$' + data.newSubtotal;
            } else {
                console.error('Validation errors:', data.errors);
            }
        } catch (error) {
            console.error('Failed to update quantity:', error);
            showAlert('No se pudo actualizar la cantidad.', 'error'); // ✨ Alerta mejorada
        }
    }
});
// document.addEventListener('DOMContentLoaded', function () {
    

//     const confirmOrderBtn = document.getElementById('confirm-order-btn');

//     if (confirmOrderBtn) {
//         const buttonText = document.getElementById('button-text');
//         const loadingSpinner = document.getElementById('loading-spinner');

//         confirmOrderBtn.addEventListener('click', function () {
//             const selectedItems = [];
//             document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
//                 selectedItems.push(checkbox.value);
//             });

//             if (selectedItems.length === 0) {
//                 alert('Por favor, seleccione al menos un artículo para continuar.');
//                 return;
//             }
            
//             const paymentMethodInput = document.querySelector('input[name="payment_method"]:checked');
//             if (!paymentMethodInput) {
//                 alert('Por favor, seleccione un método de pago.');
//                 return;
//             }

//             const notificationMethodInputs = document.querySelectorAll('input[name="notification_methods[]"]:checked');
//             if (notificationMethodInputs.length === 0) {
//                 alert('Por favor, seleccione al menos un medio de notificación.');
//                 return;
//             }


//             const paymentMethod = paymentMethodInput.value;
//             const notificationMethods = Array.from(notificationMethodInputs).map(checkbox => checkbox.value);
//             const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//             confirmOrderBtn.disabled = true;
//             buttonText.classList.add('hidden');
//             loadingSpinner.classList.remove('hidden');

//             fetch('/solicitud/crear', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify({
//                     item_ids: selectedItems,
//                     payment_method: paymentMethod, 
//                     notification_methods: notificationMethods
//                 })
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if (data.success) {
//                     alert('Solicitud creada con éxito.');
//                     window.location.reload(); // O puedes redirigir a una página de confirmación
//                 } else {
//                     alert('Error al crear la solicitud: ' + data.message);
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 alert('Ocurrió un error al procesar su solicitud.');
//             });
//         });
//     }
// const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');




// document.addEventListener('click', function (event) {
//     // Use event delegation to catch clicks on buttons, even if they are added later
//     if (!event.target.closest('.remove-from-cart-btn')) {
//         return;
//     }
//     event.preventDefault();

//     const removeButton = event.target.closest('.remove-from-cart-btn');
//     const itemElement = removeButton.closest('.cart-item');
//     const itemId = itemElement.dataset.itemId;


//     fetch(`/carrito/items/${itemId}`, {
//         method: 'DELETE',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': csrfToken
//         }
//     })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 itemElement.style.animation = 'fadeIn 0.3s ease-out reverse';
//                 setTimeout(() => {
//                     itemElement.remove();

//                     const countElement = document.getElementById('cart-item-count');
//                     const subtotalElement = document.getElementById('cart-subtotal');

//                     if (countElement) {
//                         countElement.textContent = data.newCount;
//                     }
//                     if (subtotalElement) {
//                         subtotalElement.textContent = '$' + data.newSubtotal;
//                     }

//                     // 3. Handle the case where the cart is now empty
//                     if (data.newCount === 0) {
//                         const cartBody = document.getElementById('cart-body');
//                         const cartFooter = document.getElementById('cart-footer');

//                         if (cartFooter) {
//                             cartFooter.classList.add('hidden');
//                         }

//                         // Display the "empty cart" message
//                         if (cartBody && !document.getElementById('empty-cart-message')) {
//                             const emptyMessage = `
//                             <div id="empty-cart-message" class="p-6 text-center text-gray-500">
//                                 Tu carrito está vacío.
//                             </div>`;
//                             document.querySelector('.cart-items-container').innerHTML = emptyMessage;
//                         }
//                     }

//                 }, 300); // Wait for animation to finish
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert('Failed to remove item.');
//         });
// });
// document.querySelectorAll('.options-toggle').forEach(button => {
//     button.addEventListener('click', function (e) {
//         e.stopPropagation();
//         const dropdown = this.nextElementSibling;
//         document.querySelectorAll('.options-dropdown').forEach(d => {
//             if (d !== dropdown) d.classList.add('hidden');
//         });
//         dropdown.classList.toggle('hidden');
//     });
// });

// document.body.addEventListener('click', (event) => {
//     const button = event.target.closest('.quantity-btn');
//     if (!button) return;

//     const itemElement = button.closest('.cart-item');
//     const itemId = itemElement.dataset.itemId;
//     const input = itemElement.querySelector('.quantity-input');
//     let currentQuantity = parseInt(input.value, 10);

//     const action = button.dataset.action;
//     if (action === 'increase') {
//         currentQuantity++;
//     } else if (action === 'decrease' && currentQuantity > 1) {
//         currentQuantity--;
//     }

//     input.value = currentQuantity; // Actualiza el valor visualmente de inmediato
//     updateCartQuantity(itemId, currentQuantity);
// });

// document.body.addEventListener('change', (event) => {
//     const input = event.target;
//     if (!input.classList.contains('quantity-input')) return;

//     const itemElement = input.closest('.cart-item');
//     const itemId = itemElement.dataset.itemId;
//     let newQuantity = parseInt(input.value, 10);

//     // Asegura que la cantidad no sea menor que 1
//     if (isNaN(newQuantity) || newQuantity < 1) {
//         newQuantity = 1;
//         input.value = newQuantity;
//     }

//     updateCartQuantity(itemId, newQuantity);
// });
// async function updateCartQuantity(itemId, newQuantity) {
//         try {
//             const response = await fetch(`/carrito/items/${itemId}`, {
//                 method: 'PATCH',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': csrfToken
//                 },
//                 body: JSON.stringify({
//                     quantity: newQuantity
//                 })
//             });

//             if (!response.ok) {
//                 throw new Error('Error de actualización del carrito');
//             }

//             const data = await response.json();

//             if (data.success) {
//                 // Actualiza los totales del carrito en la UI
//                 document.getElementById('cart-item-count').textContent = data.newCount;
//                 document.getElementById('cart-subtotal').textContent = '$' + data.newSubtotal;
//                 // Opcional: Actualizar el precio de este ítem específico si lo muestras
//                 // document.querySelector(`[data-item-id="${itemId}"] .item-total-price`).textContent = '$' + data.newItemPrice;
//             } else {
//                  // Si hay errores de validación, los muestra.
//                  console.error('Validation errors:', data.errors);
//                  // Podrías revertir el valor del input al original aquí.
//             }

//         } catch (error) {
//             console.error('Failed to update quantity:', error);
//         }
//     }
// });
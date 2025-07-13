// Quantity buttons functionality
document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', function () {
        const input = this.parentElement.querySelector('.quantity-input');
        let value = parseInt(input.value);

        if (this.querySelector('.fa-minus')) {
            if (value > 1) {
                input.value = value - 1;
            }
        } else {
            input.value = value + 1;
        }

        // In a real app, you would update the cart total here
    });
});
// Remove item functionality
document.querySelectorAll('.cart-item button .fa-times').forEach(button => {
    button.addEventListener('click', function () {
        const item = this.closest('.cart-item');
        item.style.animation = 'fadeIn 0.3s ease-out reverse';
        setTimeout(() => {
            item.remove();
            // In a real app, you would update the cart count and total here
        }, 300);
    });
});
document.querySelectorAll('.options-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const dropdown = this.nextElementSibling;
                document.querySelectorAll('.options-dropdown').forEach(d => {
                    if(d !== dropdown) d.classList.add('hidden');
                });
                dropdown.classList.toggle('hidden');
            });
        });


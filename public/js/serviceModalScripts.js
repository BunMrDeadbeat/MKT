document.addEventListener('DOMContentLoaded', function () {

    // --- Añadir Servicio ---
    const addServiceModalEl = document.getElementById('addServiceModal');

    if (addServiceModalEl) {
        const addServiceForm = addServiceModalEl.querySelector('form');
        const firstInput = addServiceModalEl.querySelector('input[name="name"]');

        addServiceModalEl.addEventListener('shown.bs.modal', () => {
            if (firstInput) {
                firstInput.focus();
            }
        });

        addServiceModalEl.addEventListener('hidden.bs.modal', () => {
            if (addServiceForm) {
                addServiceForm.reset();
            }
        });
    }

    // ---  Edición ---
    const editServiceModals = document.querySelectorAll('[id^="editServiceModal-"]');
    editServiceModals.forEach(modalEl => {
        const firstInput = modalEl.querySelector('input[name="name"]');
        
        modalEl.addEventListener('shown.bs.modal', () => {
            if (firstInput) {
                firstInput.focus();
            }
        });
    });

    // ---Modales de Eliminación ---
    const deleteModals = document.querySelectorAll('[id^="deleteServiceModal-"]');
    deleteModals.forEach(modalEl => {
        const deleteForm = modalEl.querySelector('form');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(event) {
                const submitButton = deleteForm.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Eliminando...`;
                }
            });
        }
    });

});

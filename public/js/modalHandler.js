/**
 * Muestra el modal global con un mensaje y tipo específicos.
 * @param {string} message - El mensaje a mostrar.
 * @param {string} [type='success'] - El tipo de modal ('success', 'error', 'info').
 */
function showGlobalModal(message, type = 'success') {
    window.dispatchEvent(new CustomEvent('show-modal', {
        detail: {
            type: type,
            message: message,
        }
    }));
}

/**
 * Un wrapper para la API Fetch que maneja automáticamente
 * las respuestas JSON y muestra modales.
 * @param {string} url - La URL a la que se hace la petición.
 * @param {object} options - Las opciones de la petición Fetch.
 * @returns {Promise<Response>}
 */
async function fetchWithModal(url, options) {
    try {
        const response = await fetch(url, options);
        const data = await response.json();

        if (data.message) {
            showGlobalModal(data.message, data.success ? 'success' : 'error');
        }

        return { response, data };
    } catch (error) {
        console.error('Fetch error:', error);
        showGlobalModal('Ocurrió un error inesperado al procesar la solicitud.', 'error');
        throw error;
    }
}
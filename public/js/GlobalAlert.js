
function showAlert(message, type = 'info') {
    const alertWrapper = document.createElement('div');
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
        default:
            bgColor = 'bg-blue-600';
            icon = `<svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
            break;
    }
    alertWrapper.className = `fixed top-5 right-5 max-w-sm w-full p-4 rounded-lg shadow-2xl text-white transform transition-all duration-300 ease-in-out z-50 ${bgColor} translate-x-full`;
    alertWrapper.innerHTML = `
        <div class="flex items-center">
            ${icon}
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(alertWrapper);
    setTimeout(() => {
        alertWrapper.classList.remove('translate-x-full');
    }, 10);
    setTimeout(() => {
        alertWrapper.classList.add('translate-x-full');
        alertWrapper.addEventListener('transitionend', () => alertWrapper.remove());
    }, 4000);
}

// Function to open/close the modal
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    loadProductOptions();
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function toggleOptionsSection(mode) {
    if(mode!='edit'){
    const optionsSection = document.getElementById('options-section');
    optionsSection.classList.toggle('hidden');
    }
    else{
        const optionsSection = document.getElementById('edit-options-section');
    optionsSection.classList.toggle('hidden');
    }
}





function addOptionValue(optionId) {
    const input = document.getElementById(`config-${optionId}-new-value`);
    const value = input.value.trim();
    if (value) {
        const valuesContainer = document.getElementById(`config-${optionId}-values`);
        const valueTag = document.createElement('div');
        valueTag.className = 'value-tag';
        valueTag.innerHTML = `
            <span>${value}</span>
            <input type="hidden" name="options[${optionId}][values][]" value="${value}">
            <button type="button" onclick="this.parentElement.remove()" class="ml-1 text-purple-800 hover:text-purple-900">
                <i class="fas fa-times"></i>
            </button>
        `;
        valuesContainer.appendChild(valueTag);
        input.value = '';
    }
}

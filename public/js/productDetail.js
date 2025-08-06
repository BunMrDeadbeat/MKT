// Gallery thumbnail click
document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
    thumb.addEventListener('click', function () {
        document.getElementById('main-image').src = this.src;
        document.querySelectorAll('.gallery-thumbnail').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});

document.addEventListener('DOMContentLoaded', function () {

    const fileUploadContainer = document.getElementById('file-upload-container');
    const fileInput = document.getElementById('design-file');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    if (fileUploadContainer && fileInput && imagePreview && previewImg) {
         fileUploadContainer.addEventListener('click', () => {
            fileInput.click();
        });

        fileUploadContainer.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadContainer.classList.add('border-primary');
        });

        fileUploadContainer.addEventListener('dragleave', () => {
            fileUploadContainer.classList.remove('border-primary');
        });

        fileUploadContainer.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadContainer.classList.remove('border-primary');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                updateFileNameAndPreview();
            }
        });

        fileInput.addEventListener('change', updateFileNameAndPreview);

        function updateFileNameAndPreview() {
            if (fileInput.files.length > 0) {
                const maxSize = 10 * 1024 * 1024;
                const errorElement = document.getElementById('thumb-file-size-error');
                errorElement.textContent = '';
              
                const file = fileInput.files[0];
                if (file.type.startsWith('image/')) {
                    if (file.size > maxSize) {

                        errorElement.textContent = 'Imagen demasiado grande. El tamaño maximo es 10MB.';
                    }
                    else{
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                    }
                } else {
                    imagePreview.classList.add('hidden');
                }
            } else {
                imagePreview.classList.add('hidden');
            }
        }

    }

    // Validación de campos numéricos
    const numberInputs = document.querySelectorAll('input[type="number"]');
    if (numberInputs.length > 0) {
        numberInputs.forEach(input => {
            input.addEventListener('input', function () {
                if (this.value < 1) {
                    this.value = 1;
                }
            });
        });
    }

    const professionalRadio = document.getElementById('professional-radio');
    const uploadRadio = document.getElementById('upload-radio');
    const professionalCheckbox = document.getElementById('professional-checkbox');
    const ideaTextarea = document.getElementById('idea-textarea');
    const fileUploadSection = document.getElementById('file-upload-section');

    if (professionalRadio && uploadRadio && ideaTextarea && fileUploadSection && fileInput) {
        // Both options 2 and 4 are present
        ideaTextarea.disabled = false; // Enabled by default with professional radio checked
        fileUploadSection.style.display = 'none';
        fileInput.disabled = true;

        professionalRadio.addEventListener('change', function () {
            ideaTextarea.disabled = false;
            fileUploadSection.style.display = 'none';
            fileInput.disabled = true;
            imagePreview.classList.add('hidden');
        });

        uploadRadio.addEventListener('change', function () {
            ideaTextarea.disabled = true;
            fileUploadSection.style.display = 'block';
            fileInput.disabled = false;
        });
    } else if (professionalCheckbox && ideaTextarea) {
        // Only option 2 is present
        ideaTextarea.disabled = !professionalCheckbox.checked;

        professionalCheckbox.addEventListener('change', function () {
            ideaTextarea.disabled = !this.checked;
        });
    } else if (fileUploadSection && fileInput) {
        // Only option 4 is present
        fileUploadSection.style.display = 'block';
        fileInput.disabled = false;
    }


    /////////////////////////////
     const mainImage = document.getElementById('main-image');
    const imageOverlay = document.getElementById('image-overlay');
    const zoomedImage = document.getElementById('img-zoomed');
    const closeButton = document.querySelector('.close-button');
    mainImage.addEventListener('click', function() {
     
        zoomedImage.src = this.src;
     
        imageOverlay.classList.add('visible');
    });

    closeButton.addEventListener('click', function() {
      
        imageOverlay.classList.remove('visible');
    });

    
    imageOverlay.addEventListener('click', function(event) {
        if (event.target === imageOverlay) {
            imageOverlay.classList.remove('visible');
        }
    });

    
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && imageOverlay.classList.contains('visible')) {
            imageOverlay.classList.remove('visible');
        }
    });
});

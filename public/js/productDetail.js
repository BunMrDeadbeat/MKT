        // Gallery thumbnail click
        document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
            thumb.addEventListener('click', function() {
                // Update main image
                document.getElementById('main-image').src = this.src;
                
                // Update active state
                document.querySelectorAll('.gallery-thumbnail').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // File upload functionality
        const fileUploadContainer = document.getElementById('file-upload-container');
        const fileInput = document.getElementById('design-file');
        const fileNameDisplay = document.getElementById('file-name');
        
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
                updateFileName();
            }
        });
        
        fileInput.addEventListener('change', updateFileName);
        
        function updateFileName() {
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = fileInput.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            } else {
                fileNameDisplay.classList.add('hidden');
            }
        }
        
        // Numeric input validation
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                if (this.value < 1) {
                    this.value = 1;
                }
            });
        });
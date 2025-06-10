
       
        let currentTab = 'products';
        let currentEditId = null;
        let deleteCallback = null;

        // prenda el dashboard
        
           
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('product-search');
            const categorySelect = document.getElementById('product-category');
            const statusSelect = document.getElementById('product-status');
            const productList = document.getElementById('product-list');

            // Función para aplicar filtros
            function applyFilters() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categorySelect.value;
                const selectedStatus = statusSelect.value;

                Array.from(productList.getElementsByTagName('tr')).forEach(row => {
                    const productName = row.querySelector('td:nth-child(1) .text-gray-900')?.textContent.toLowerCase() || '';
                    const productCategory = row.querySelector('td:nth-child(2) .text-gray-900')?.textContent.trim() || '';
                    const productStatus = row.querySelector('td:nth-child(3) span')?.textContent.trim() || '';

                    const matchesSearch = productName.includes(searchTerm);
                    const matchesCategory = !selectedCategory || productCategory === selectedCategory;
                    const matchesStatus = !selectedStatus || productStatus === selectedStatus;

                    row.style.display = (matchesSearch && matchesCategory && matchesStatus) ? '' : 'none';
                });
            }

            // Eventos en tiempo real
            searchInput.addEventListener('input', applyFilters);
            categorySelect.addEventListener('change', applyFilters);
            statusSelect.addEventListener('change', applyFilters);

            const toolbarOptions = [
                // Header
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                // Font & Size
                [{ 'font': [] }], 
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'align': [] }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
            ];

            // Initialize Editors
            const quilladd = new Quill('#editorA', {
                theme: 'snow',
                modules: {
                    toolbar: toolbarOptions
                }
            });
            const contentInputa = document.getElementById('description');
            quilladd.on('text-change', function () {
                contentInputa.value = quilladd.root.innerHTML;
            });

            const editor = document.getElementById('editorE');
            if (editor && !editor.classList.contains('ql-container')) {
                const quilledit = new Quill('#editorE', {
                    theme: 'snow',
                    modules: {
                        toolbar: toolbarOptions
                    }
                });

                const contentInput = document.getElementById('editdescription');
                quilledit.on('text-change', function () {
                    contentInput.value = quilledit.root.innerHTML;
                });
            }
        });
        // Tab switching
        function switchTab(tabName) {
            currentTab = tabName;
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-mktPurple', 'text-mktPurple');
                button.classList.add('border-transparent', 'text-gray-500');
            });
            
            document.querySelector(`[onclick="switchTab('${tabName}')"]`)
                .classList.add('border-mktPurple', 'text-mktPurple');
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(`${tabName}-tab`).classList.add('active');
        }

        let selectedFiles = [];
        function openProductModal() {
            const modal = document.getElementById('product-modal');
            
                //title.textContent = 'Nuevo Producto';
                document.getElementById('product-name').value = '';
                document.getElementById('product-price').value = '';
                document.getElementById('product-status-modal').value = 'active';
                document.getElementById('product-gallery-preview').innerHTML = '';
                document.getElementById('thumb-file-size-error').innerHTML='';
                document.getElementById('gallery-error').innerHTML='';
                document.getElementById('product-file-size-display').innerHTML='';

                selectedFiles = [];
            
            modal.classList.remove('hidden');
        }

     
        document.getElementById('edit-product-gallery-upload').addEventListener('change', function(e) {      
            const files = e.target.files;
            const galleryPreview = document.getElementById('edit-product-gallery-preview');
            const currentImageCount = galleryPreview.querySelectorAll('.relative').length;
            const maxImages = 10;
            const maxTotalSize = 100 * 1024 * 1024;
            const errorElement = document.getElementById('edit-gallery-error');
            errorElement.textContent = '';

            const newCount = files.length;

            if (currentImageCount + newCount > maxImages) {
                errorElement.textContent = `Solo se pueden tener ${maxImages} imágenes por producto. Actualmente hay ${currentImageCount}, y estás intentando añadir ${newCount}.`;
                return;
            }

            const currentTotalSize = selectedFiles.reduce((sum, file) => sum + file.size, 0);
            const newTotalSize = Array.from(files).reduce((sum, file) => sum + file.size, 0);
            const totalSizeAfter = currentTotalSize + newTotalSize;

            if (totalSizeAfter > maxTotalSize) {
                errorElement.textContent = `El tamaño total de las nuevas imágenes excede el límite de 100MB.`;
                return;
            }

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                selectedFiles.push(file);
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const thumbnail = document.createElement('div');
                    thumbnail.className = 'relative';
                    thumbnail.file = file;
                    thumbnail.innerHTML = `
                        <img src="${event.target.result}" onclick="showNewThumbAlertMessage()" class="w-full h-20 object-cover rounded">
                        <button onclick="removeGalleryImage(this)" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        <i class="fas fa-times"></i>
                        </button>
                    `;
                    galleryPreview.appendChild(thumbnail);
                };
                
                reader.readAsDataURL(file);
            }
        });
        function replaceThumb(id, path){
             const imagePreview = document.querySelector('.edit-product-image-preview');
             const imageStored = document.getElementById('image-data');
             imageStored.value = id;
            imagePreview.innerHTML = `<img src="/storage/${path}" class="w-full h-full object-contain">`;    
        }
        
        function showNewThumbAlertMessage() {
            alert("Alerta. primero deben de guardarse las imagenes nuevas para usarlas como thumbnail");
        }

        

        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('collapsed');
        }

        

        function closeModal(modalId) {
            
            document.getElementById(modalId).classList.add('hidden');
            currentEditId = null;
        }

        function openDeleteModal(product) {
            const modal = document.getElementById('delete-modal');
            const title = document.getElementById('delete-modal-title');
            const message = document.getElementById('delete-modal-message');
            const form = document.getElementById('delete-form');
            
            title.textContent = `Eliminar ${product.name}`;
            message.textContent = `¿Estás seguro de que deseas eliminar "${product.name}"? Esta acción no se puede deshacer.`;
            form.action = `/admin/productos/destroy/${product.id}`;

            modal.classList.remove('hidden');
        }

        function confirmDelete() {
            if (deleteCallback && currentEditId) {
                deleteCallback(currentEditId);
            }
            closeModal('delete-modal');
        }

        
        


        // Image upload p review
        document.getElementById('product-image-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const maxSize = 10 * 1024 * 1024;
            const errorElement = document.getElementById('thumb-file-size-error');
            errorElement.textContent = '';
    

            if (file) {
                 if (file.size > maxSize)
                {

                 errorElement.textContent = 'Imagen demasiado grande. El tamaño maximo es 10MB.';
                }
                else
                {const reader = new FileReader();
                reader.onload = function(event) {
                    document.querySelector('.product-image-preview').innerHTML = `
                    <img src="${event.target.result}" class="w-full h-full object-contain">
                    <button onclick="removeProductImage()" class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                };
                reader.readAsDataURL(file);}
            }
        });

    

        
        document.getElementById('product-gallery-upload').addEventListener('change', function(e) {
            const files = e.target.files;
            const galleryPreview = document.getElementById('product-gallery-preview');
            const maxImages = 10;
            const maxTotalSize = 100 * 1024 * 1024;
            
            const errorElement = document.getElementById('gallery-error');
            errorElement.textContent = '';
            
            const currentCount = selectedFiles.length;
            const newCount = files.length;

            if (currentCount + newCount > maxImages) {
                if(currentCount==10)
                {errorElement.textContent = `${newCount} de más. El maximo es: ${maxImages} imagenes por producto.`;
                return;}
                else{
                    errorElement.textContent = `Solo se pueden añadir ${maxImages} imagenes por producto. Ingresaste ${newCount} y hay ${currentCount}. Eso es un ${currentCount+newCount}`;
                return;
                }
            }

            const currentTotalSize = selectedFiles.reduce((sum, file) => sum + file.size, 0);
            const newTotalSize = Array.from(files).reduce((sum, file) => sum + file.size, 0);
            const totalSizeAfter = currentTotalSize + newTotalSize;

            if (totalSizeAfter > maxTotalSize) {
                errorElement.textContent = `Tamaño total de imagenes sobrepasa el limite de 100MB. Elija otra o reduce el tamaño.`;
                return;
            }
            const convertedSize = totalSizeAfter /(1024*1024);
            document.getElementById('product-file-size-display').textContent = `${convertedSize.toFixed(2)}MB`;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                selectedFiles.push(file);
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    const thumbnail = document.createElement('div');
                    thumbnail.className = 'relative';
                    thumbnail.innerHTML = `
                        <img src="${event.target.result}" class="w-full h-20 object-cover rounded">
                        
                    `;
                    galleryPreview.appendChild(thumbnail);
                };
                
                reader.readAsDataURL(file);
            }
        });
        
        function removeProductImage() {
            document.querySelector('.product-image-preview').innerHTML = '';
            document.getElementById('product-image-upload').value = null;
        }
        
        function removeGalleryImage(button) {
            const thumbnail = button.parentNode;
            if (thumbnail.file) {
                selectedFiles = selectedFiles.filter(f => f !== thumbnail.file);
            }
            else {
                const imageId = thumbnail.getAttribute('data-id');
                if (imageId) {
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_gallery[]';
                    deleteInput.value = imageId;
                    document.getElementById('edit-product-image-media').appendChild(deleteInput);
                }
            }
            thumbnail.remove(); 
        }


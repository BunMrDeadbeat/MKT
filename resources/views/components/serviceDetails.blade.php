<div id="ProductDetails" class="w-full">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-5xl font-bold text-primary mb-6 text-center">{{ $title }}</h1>

        <div id='richDescription' class="text-gray-700 mb-6 quill-content rounded-lg p-4 bg-stone-100">
            {!! $description !!}
        </div>
        <div x-data="{ 
    modalOpen: false,
    loading: false,
    submitVerification() {
        this.loading = true;
        const form = document.getElementById('verificationForm');
        const formData = new FormData(form);

        fetch('{{ route('service.request.submit', ['servicio' => $serviceId]) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                this.modalOpen = false;
                showAlert('¡Solicitud enviada con éxito! Revise su bandeja de entrada y la carpeta de correo no deseado. Pronto nos comunicaremos con usted'); 
            } else {
                showAlert('Error: ' + (data.message || 'No se pudo enviar la solicitud.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Ocurrió un error de conexión. Por favor, inténtalo de nuevo.');
        })
        .finally(() => {
            this.loading = false;
        });
    }
}">
<div class="mx-5 my-3 flex snap-center">
@auth
    <button @click.prevent="modalOpen = true"
        class="bg-primary hover:bg-purple-800 text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
        <i class="fas fa-paper-plane"></i>
        <span>Solicitar</span>
    </button>
    @else
    <button onclick="showAlert('Por favor ingrese o cree una cuenta para realizar su solicitud.')"
        class="bg-primary hover:bg-purple-800 text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
        <i class="fas fa-paper-plane"></i>
        <span>Solicitar</span>
    </button>
@endauth
</div>
    

<div x-show="modalOpen" 
                 class="fixed z-10 inset-0 flex items-center justify-center p-4" 
                 aria-labelledby="modal-title" 
                 role="dialog" 
                 aria-modal="true" 
                 style="display: none;">
                
                <div x-show="modalOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                     @click="modalOpen = false" 
                     aria-hidden="true"></div>

                <div x-show="modalOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative bg-white rounded-lg text-left shadow-xl transform transition-all sm:max-w-lg sm:w-full flex flex-col max-h-[80vh]">
                     
                    <div class="flex-grow p-6 overflow-y-auto">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-user-check text-blue-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Por favor verifica que tus datos sean correctos
                                </h3>
                                <div class="mb-4 bg-gray-100 p-3 rounded-md">
                                    
                                    <div class="mb-4 ">
                                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                        <p class="mt-1 sm:text-sm text-gray-900">{{ auth()->user()->name ?? '' }}</p>
                                    </div>

                                    <div class="mb-4">
                                        @php
                                            // Prepara el número de teléfono para mostrarlo, eliminando el '1' obsoleto.
                                            $telefono_display = auth()->user()->telefono ?? '';
                                            if (preg_match('/^(\+52)1(\d{10})$/', $telefono_display, $matches)) {
                                                $telefono_display = $matches[1] . $matches[2];
                                            }
                                        @endphp
                                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                                        <p class="mt-1 sm:text-sm text-gray-900">{{ $telefono_display }}</p>
                                        <span class="text-green-800/60 text-xs"><i class="fa-solid fa-circle-info"></i> En DuranMKT hacemos uso de whatsapp para contacto por mensaje</span>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Correo</label>
                                        <p class="mt-1 sm:text-sm text-gray-900">{{ auth()->user()->email ?? '' }}</p>
                                    </div>
                            </div>
                            
                                <div class="mt-4">
                                    <form id="verificationForm">
                                        <input type="hidden" name="product_id" value="{{ $serviceId }}">
                                    

                                    <hr class="my-6">

                                    <h4 class="text-md font-semibold text-gray-800 mb-3">Información de la Empresa</h4>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="company_name" class="block text-sm font-medium text-gray-700">Nombre de su empresa<span class="text-red-600">*</span></label>
                                            <input type="text" name="company_name" id="company_name" class="p-4 mt-1 block w-full shadow-md sm:text-sm border-gray-600 rounded-md" required>
                                        </div>
                                        <div>
                                            <label for="company_field" class="block text-sm font-medium text-gray-700">Giro de su empresa<span class="text-red-600">*</span></label>
                                            <input type="text" name="company_field" id="company_field" class="p-4 mt-1 block w-full shadow-md sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        <div>
                                            <label for="company_role" class="block text-sm font-medium text-gray-700">Su Puesto en la Empresa<span class="text-red-600">*</span></label>
                                            <input type="text" name="company_role" id="company_role" class="p-4 mt-1 block w-full shadow-md sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                      
                                        <div>
                                            <label for="company_size" class="block text-sm font-medium text-gray-700">Tamaño de la Empresa<span class="text-red-600">*</span></label>
                                            <select name="company_size" id="company_size" class="mt-1 block w-full py-4 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option>1-10 empleados</option>
                                                <option>11-50 empleados</option>
                                                <option>51-200 empleados</option>
                                                <option>201-500 empleados</option>
                                                <option>+500 empleados</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label for="website" class="block text-sm font-medium text-gray-700">Sitio Web Actual y/o Red Social Principal</label>
                                        <input type="url" name="website" id="website" class="p-2 mt-1 block w-full shadow-md sm:text-sm border-gray-300 rounded-md" placeholder="https://ejemplo.com">
                                    </div>

                                    <div class="mt-4">
                                        <label for="project_details" class="block text-sm font-medium text-gray-700">Cuéntanos brevemente sobre tu principal desafío o proyecto<span class="text-red-600">*</span></label>
                                        <textarea name="project_details" id="project_details" rows="4" class="p-2 mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                        @if (!$hasprice)
                                          
                                        <div>
                                            <label for="budget" class="block text-sm font-medium text-gray-700">Presupuesto Estimado (MXN)<span class="text-red-600">*</span></label>
                                            <select name="budget" id="budget" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option>A discutir</option>
                                                <option>Menos de $10,000</option>
                                                <option>$10,000 - $40,0000</option>
                                                <option>$40,0000 - $200,000</option>
                                                <option>Más de $200,000</option>
                                            </select>
                                        </div>
                                          
                                        @endif
                                        <div>
                                            <label for="urgency" class="block text-sm font-medium text-gray-700">Nivel de Urgencia<span class="text-red-400">*</span></label>
                                            <select name="urgency" id="urgency" class="mb-3 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option>Baja</option>
                                                <option>Media</option>
                                                <option>Alta</option>
                                                <option>Inmediata</option>
                                            </select>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-2 py-1 sm:px-3 sm:flex sm:flex-row-reverse flex-shrink-0">
                        <button @click="submitVerification()" :disabled="loading" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm" :class="{ 'opacity-50 cursor-not-allowed': loading }">
                            <span x-show="!loading">Confirmar Solicitud</span>
                            <span x-show="loading">Enviando...</span>
                        </button>
                        <button @click="modalOpen = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-red-200 text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancelar
                        </button>
                        <a href="{{ route('user.dash') }}#modificar" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-2 py-2 bg-blue-300 text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm sm:mr-auto">
                            Modificar Datos
                        </a>
                    </div>
                </div>
            </div>
            </div>

        <div class="border-t border-gray-200 pt-4">
            <div class="flex items-center text-gray-600 mb-2">
                <i class="fas fa-truck mr-2"></i>
                <span>Los servicios generan una solicitud, ¡nosotros nos pondremos en contacto!</span>
            </div>
        </div>
    </div>
</div>
</div>
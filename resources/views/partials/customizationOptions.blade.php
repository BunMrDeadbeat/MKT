<div class="my-16 w-full mx-auto border-3 inset-shadow-purple-800 shadow-xl p-4 md:p-12">
    
            <input class="hidden" value="{{ $productid }}" name="producto_id">

            @php
$optionIds = $options->pluck('id')->toArray();
$hasOption2 = in_array('2', $optionIds);
$hasOption3 = in_array('3', $optionIds);
$hasOption10 = in_array('10', $optionIds);
$hasOption11 = in_array('11', $optionIds);
            @endphp
            <div id=check>
                @foreach ($options as $option)

                    @if ($option->id == '1')
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tamaño cuadrado (en metros)</label>
                            <div class="flex items-center space-x-3 ">
                                <input type="number" name="alto"
                                    class="form-input flex-1 block w-full rounded-md border-gray-300 border-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    placeholder="Alto" min="1" value='1'>
                                <span class="text-gray-500 text-lg font-semibold">X</span>
                                <input type="number" name="ancho"
                                    class="form-input flex-1 block w-full rounded-md border-gray-300 border-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                    placeholder="Ancho" min="1" value='1'><a class=" font-semibold text-sm w-1/4 m-1">Metros cuadrados</a>
                            </div>
                        </div>
                    @endif

                    @if ($option->id == '2')
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md" id="design-section">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Diseño</label>
                            @if ($hasOption3)
                                <!-- Both options 2 and 4 are present: use radio buttons -->
                                <div class="space-y-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="design_choice" value="professional" class="form-radio" checked
                                            id="professional-radio">
                                        <span class="ml-2">Quiero que un profesional me apoye con el diseño</span>
                                    </label>
                                    <div id="idea-input" class="mt-2 border-2 p-2 rounded-sm">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">¿Qué tiene en mente?</label>
                                        <textarea name="idea" id="idea-textarea" placeholder="Quiero un diseño que incluya..."
                                            class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                            rows="3"></textarea>
                                    </div>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="design_choice" value="upload" class="form-radio" id="upload-radio">
                                        <span class="ml-2">Quiero subir mi propio diseño</span>
                                    </label>
                                </div>
                            @else
                                <!-- Only option 2 is present: use checkbox with textarea -->
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="professional_design" class="form-checkbox" id="professional-checkbox">
                                    <span class="ml-2">Quiero que un profesional me apoye con el diseño</span>
                                </label>
                                <div id="idea-input" class="mt-2 border-2 p-2 rounded-sm">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">¿Qué tiene en mente?</label>
                                    <textarea name="idea" id="idea-textarea"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                        rows="3" disabled></textarea>
                                </div>
                            @endif
                        </div>
                    @endif

                    @if ($option->id == '4')
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                            <div class="w-full">
                            <input type="text" name="cantidad" value="1"
                                class="form-input block w-50 rounded-md border-gray-300 border-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                            </div>
                        </div>
                    @endif

                    @if ($option->id == '3')
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md" id="file-upload-section">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Diseño</label>
                            <div id="file-upload-container"
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-gray-400 transition duration-200 ease-in-out">
                                <div class="space-y-1 text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                    <div class="flex text-sm text-gray-600">
                                        <p class="pl-1">Arrastra tu archivo aquí o presiona para seleccionar</p>
                                    </div>
                                    <p class="text-xs text-gray-500">Formatos aceptados: JPG, PNG, SVG, WEBP. Máximo 10 MB</p>
                                    <input type="file" id="design-file" name="design" class="hidden" accept=".jpg,.jpeg,.png,.svg,.webp">
                                </div>
                            </div>
                             <div id="thumb-file-size-error" class="border-l-4 show bg-red-100 border-red-500 text-red-700"></div>

                            <div id="image-preview" class="mt-4 hidden">
                                <img id="preview-img" src="" alt="Image Preview" class="max-w-full h-auto rounded-md">
                            </div>
                        </div>
                        @if (!$hasOption2)
                            <input type="hidden" name="design_choice" value="upload">
                        @endif
                    @endif

                    @if ($option->id == '5' && !$hasOption11)
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de vinilo</label>
                            <select name="tipo_vinilo"
                                class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                                <option value="">Seleccione un tipo</option>
                                <option value="cortado">Cortado</option>
                                <option value="impreso">Impreso</option>
                                <option value="microperforado">Microperforado</option>
                            </select>
                        </div>
                    @endif

                    @if ($option->id == '6')

                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Diámetro (en cm)</label>
                            <input type="number" name="diametro"
                                class="form-input block w-full rounded-md border-gray-300 border-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                min="1" placeholder="Ingrese el diámetro">
                        </div>

                    @endif

                    @if ($option->id == '7')
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tamaño</label>
                            <select name="tamano"
                                class="form-input block w-full rounded-md border-gray-300 shadow-sm shadow-gray-900 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                                <option value="">Seleccione un tamaño</option>
                                <option value="carta">Carta</option>
                                <option value="media-carta">Media Carta</option>
                                <option value="cuarto-carta">Cuarto de Carta</option>
                            </select>
                        </div>
                    @endif

                    @if ($option->id == '8')
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                            <div class="flex flex-wrap gap-3 mt-2">
                                @php
                                    $colors = [
                                        'negro' => '#000000',
                                        'blanco' => '#FFFFFF',
                                        'rojo' => '#FF0000',
                                        'verde' => '#008000',
                                        'azul' => '#0000FF',
                                        'amarillo' => '#FFFF00',
                                        'naranja' => '#FFA500',
                                        'morado' => '#800080',
                                        'gris' => '#808080',
                                    ];
                                @endphp
                                @foreach ($colors as $name => $hex)
                                    <div>
                                        <input type="radio" name="color" id="color-{{ $name }}" value="{{ $name }}" class="sr-only peer">
                                        <label for="color-{{ $name }}"
                                            class="block w-8 h-8 rounded-full cursor-pointer border-2 {{ $name === 'blanco' ? 'border-gray-400' : 'border-transparent' }} peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-indigo-500"
                                            style="background-color: {{ $hex }};" title="{{ ucfirst($name) }}">
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($option->id == '9')

                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cara</label>
                            <select name="cara"
                                class="form-input block w-full rounded-md border-gray-300 shadow-sm shadow-gray-900 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2">
                                <option value="">Seleccione una opción</option>
                                <option value="una-cara">Una cara</option>
                                <option value="doble-cara">Doble cara</option>
                            </select>
                        </div>
                    @endif

                    @if ($option->id == '10')
                    @if (!$hasOption11)
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Detalles Extra</label>
                            <textarea name="detalles_extra"
                                class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                rows="4"
                                placeholder="Proporcione detalles adicionales como colores específicos, instrucciones de instalación, etc."></textarea>
                        </div>
                    @else
                        <div class="form-control my-5 shadow-black/50 shadow-lg p-4 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Detalles de su solicitud</label>
                            <textarea name="detalles_extra"
                                class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2"
                                rows="6"
                                placeholder="Proporcione detalles sobre el producto o servicio que desea."></textarea>
                        </div>
                    @endif
                    @endif
                    @if ($option->id == '11')
                        {{-- no usar pero dejar campo intacto --}}
                    @endif
                    @if ($option->id == '12')

                    @endif
                @endforeach
                @if ($hasOption11)
                    <input type="hidden" name="no_cotizacion" value="1">

                    @else
                    <input type="hidden" name="no_cotizacion" value="0">
                @endif
            </div>
        </div>
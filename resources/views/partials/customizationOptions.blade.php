<form id="customizationForm">
    @csrf
        <div class="mb-6">
            <div class="form-control">
                <label class="form-label">Tamaño cuadrado (en m)</label>
                <div class="size-input-container">
                    <input type="number" name="alto" class="form-input size-input" placeholder="Alto" min="1">
                    <span class="size-separator">X</span>
                    <input type="number" name="ancho" class="form-input size-input" placeholder="Ancho" min="1">
                </div>
            </div>
            
            <div class="form-control">
                <label class="form-label">Diseño</label>
                <div id="file-upload-container" class="file-upload">
                    <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                    <div class="file-upload-text">
                        <p>Arrastra tu archivo aquí o haz clic para seleccionar</p>
                        <p class="text-xs">Formatos aceptados: JPG, PNG, PDF</p>
                    </div>
                    <input type="file" id="design-file" name="design" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                    <div id="file-name" class="file-name hidden"></div>
                </div>
            </div>
            
            <div class="form-control">
                <label class="form-label">Cantidad</label>
                <input type="number" name="cantidad" class="form-input" min="1" value="1">
            </div>
            
            <div class="form-control">
                <label class="form-label">Tamaño</label>
                <select name="tamano" class="form-input">
                    <option value="">Seleccione un tamaño</option>
                    <option value="carta">Carta</option>
                    <option value="media-carta">Media Carta</option>
                    <option value="cuarto-carta">Cuarto de Carta</option>
                </select>
            </div>
            
            <div class="form-control">
                <label class="form-label">Diámetro (en m)</label>
                <input type="number" name="diametro" class="form-input" min="1" placeholder="Ingrese el diámetro">
            </div>
            
            <div class="form-control">
                <label class="form-label">Cara</label>
                <select name="cara" class="form-input">
                    <option value="">Seleccione una opción</option>
                    <option value="una-cara">Una cara</option>
                    <option value="doble-cara">Doble cara</option>
                </select>
            </div>
        </div>
    </form>
@props(['title', 'price', 'description','productid'])

<div id="ProductDetails">
    <h1 class="text-3xl font-bold text-primary mb-2">{{ $title }}</h1>
    
    <div class="mb-6">
        <span class="text-2xl font-bold">${{ $price }}</span>
    </div>
    
    <p class="text-gray-700 mb-6">
        {{ $description }}
    </p>
   
    {{-- @include('partials.customizationOptions') --}}
    <form id="customizationForm" action="{{ route('orders.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div class="mb-6">
            <div class="form-control">
                <label class="form-label">Tamaño cuadrado (en m)</label>
                <div class="size-input-container">
                    <input type="number" name="alto" class="form-input size-input" placeholder="Alto" min="1" value='1'>
                    <span class="size-separator">X</span>
                    <input type="number" name="ancho" class="form-input size-input" placeholder="Ancho" min="1" value='1'>
                </div>
            </div>
            <input class="hidden" value="{{ $productid }}" name="producto_id">
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
        
    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <button id="buyButton" type="submit" class="bg-primary hover:bg-purple-800 text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
            <i class="fas fa-shopping-cart"></i>
            <span>Comprar</span>
        </button>
    </div>
    </form>
    
    
    <div class="border-t border-gray-200 pt-4">
        <div class="flex items-center text-gray-600 mb-2">
            <i class="fas fa-truck mr-2"></i>
            <span>Los productos se recogen en local</span>
            @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        </div>
    </div>
</div>

@section('scripts')
<script>

</script>
@endsection
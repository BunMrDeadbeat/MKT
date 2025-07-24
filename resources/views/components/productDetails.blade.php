@props(['title', 'price', 'description', 'productid', 'options'])

<div id="ProductDetails" class="w-full md:w-1/2">
    <h1 class="text-3xl font-bold text-primary mb-2">{{ $title }}</h1>

    <div class="mb-6">
        @if ($price != null && $price != 0)
            @php
    $displayPrice = (int) ltrim($price, '$');
            @endphp
            <span class="text-2xl font-bold">${{ $displayPrice }}</span>
        @else
            Nosotros te cotizaremos!
        @endif
    </div>
     <div class="border-t border-gray-200 pt-4">
        <div class="flex items-center text-gray-600 mb-2">
            <i class="fas fa-truck mr-2"></i>
            <span>Los productos se recogen en local</span>
            
        </div>
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('message'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    {{ session('message') }}
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
    
    <h3 class=" font-bold text-2xl">Opciones para personalización:</h3>
    {{-- @include('partials.customizationOptions') --}}
    <form id="customizationForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @include('partials.customizationOptions')

        <div class="flex flex-col md:flex-row gap-4 mb-6">
            {{-- Button 1: Submits to the 'orders.buyNow' route --}}
        <button type="submit"
                formaction="{{ route('orders.store') }}"
                class="bg-primary hover:bg-purple-800 text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
            <span>Ordenar ya</span>
        </button>
        
        {{-- Button 2: Submits to the 'cart.add' route --}}
        <button type="submit"
                formaction="{{ route('orders.storeCart') }}"
                class="bg-green-700 hover:bg-mktGreen text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
                
            <i class="fas fa-shopping-cart"></i>
            <span>Agregar al carrito</span>
        </button>

        </div>
    </form>


   
</div>

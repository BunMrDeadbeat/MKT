@props(['title', 'price', 'description', 'productid'])

<div id="ProductDetails">
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

    <div id='richDescription'class="text-gray-700 mb-6 quill-content rounded-lg p-4 bg-stone-100">
        {{-- Using Quill for rich text display --}}
        {!! $description !!}
    </div>

    {{-- @include('partials.customizationOptions') --}}
    <form id="customizationForm" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('partials.customizationOptions', ['productid' => $productid])

        <div class="flex flex-col md:flex-row gap-4 mb-6">
            <button id="buyButton" type="submit"
                class="bg-primary hover:bg-purple-800 text-white py-3 px-6 rounded-lg font-bold flex-1 flex items-center justify-center space-x-2">
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

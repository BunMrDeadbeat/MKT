@extends('layouts.storeLayout')
    @section('content')
<main class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        
        {{-- Cart Items Section --}}
        <div class="lg:w-2/3">
            @include('partials.cart.cart-items', ['items' => $cartItems])
        </div>
        
        {{-- Order Summary Section --}}
        <div class="lg:w-1/3">
            @include('partials.cart.order-summary')
            @include('partials.cart.security-info')
        </div>
        
    </div>
</main>


    @endsection
    @section('scripts')
         <script src="{{ asset('js/modalHandler.js') }}"></script>
        <script src="{{ asset('js/cartScripts.js') }}"></script>

    @endsection
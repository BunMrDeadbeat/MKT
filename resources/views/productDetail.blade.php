@extends('layouts.storeLayout')


@section('content')
<section style="background-image: url('/storage/images/tienda.webp'); background-size: 30%; background-repeat: repeat; background-attachment: fixed;">
@include('partials.breadcrumbs')
    
    @php
$featuredGallery = $product->galleries->firstWhere('is_featured', 1);
$otherGalleries = $product->galleries;
$galleryImageUrls = [];
foreach ($otherGalleries as $gallery) {
    if ($gallery->image) { // Ensure the image path exists
        $galleryImageUrls[] = asset('storage/' . $gallery->image);
    }
}
    @endphp


    @if ($product->type == 'product')
    <section class="container mx-auto px-2 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden  shadow-zinc-700">
            <div class="flex flex-col md:flex-row gap-8 p-6">
                <x-productGallery 
                :thumbnail="$featuredGallery->image"
                :images="$galleryImageUrls"
                :description="$product->description"/>
                 
                
                <x-productDetails 
                    :options="$product->options"
                    :productid="$product->id"
                    :title="$product->name"
                    :price="$product->price"
                    :description="$product->description"/>
            </div>
        </div>
    </section>
    @else
    <section class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col gap-8 p-6">
                <x-serviceGallery 
                :thumbnail="$featuredGallery->image"
                :images="$galleryImageUrls" />
                @php
                    $hasPrice = false;
                    if($product->price!=null && $product->price > 0){
                        $hasPrice = true;
                    }
                @endphp
                <x-serviceDetails 
                    :title="$product->name"
                    :price="$product->price"
                    :description="$product->description"
                    :serviceId="$product->id"
                    :hasprice="$hasPrice"
                    />
            </div>
        </div>
    </section>
    @endif
</section>
@endsection


    @section('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const options = {
                    readOnly: true,
                    modules: {
                        toolbar: null
                    },
                    theme: 'snow'
                };
                const quill = new Quill('#richDescription', options);

   
               
            });
        </script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src ="{{ asset('js/GlobalAlert.js') }}" defer></script>
        <script src = "{{ asset('js/productDetail.js') }}" defer></script>
        

    @endsection
@extends('layouts.storeLayout')


@section('content')
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
    <section class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
                <x-productGallery 
                :thumbnail="$featuredGallery->image"
                :images="$galleryImageUrls" />
                
                <x-productDetails 
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
                
                <x-serviceDetails 
                    :title="$product->name"
                    :price="$product->price"
                    :description="$product->description"/>
            </div>
        </div>
    </section>
    @endif

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
    <script src = "{{ asset('js/productDetail.js') }}" defer>
    </script>
    
    @endsection
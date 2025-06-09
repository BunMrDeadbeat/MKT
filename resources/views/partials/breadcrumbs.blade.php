<div class="container mx-auto px-4 py-3 text-md text-gray-600">
    <a href="{{ '/' }}" class="hover:text-primary">inicio</a> > 
    <a href="{{ '/store' }}" class="hover:text-primary">tienda</a> > 
    <a href="/store/{{ $product->category->id }}" class="hover:text-primary">{{ $product->category->name }}</a> > 
    <span class="text-primary">{{$product->name}}</span>
</div>
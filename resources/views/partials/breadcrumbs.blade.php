<div class="container  px-4 py-3 text-md font-bold text-gray-200  from-zinc-900 to-zinc-100/0 bg-gradient-to-r rounded-br-full ">
    <a href="{{ '/' }}" class="hover:text-primary">inicio</a> > 
    <a href="{{ '/store' }}" class="hover:text-primary">tienda</a> > 
    <a href="/store/{{ $product->category->id }}" class="hover:text-primary">{{ $product->category->name }}</a> > 
    <span class=" underline text-black underline-offset-5">{{$product->name}}</span>
</div>
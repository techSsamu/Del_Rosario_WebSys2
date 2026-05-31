@extends('app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Products</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Product</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-bold mb-2">{{ $product->name }}</h2>
                <p class="text-gray-600 mb-4">Price: ${{ $product->price }}</p>
                
                @if($product->qr)
                    <div class="mb-4 text-center">
                        {!! $product->qr !!}
                    </div>
                @endif

                <div class="flex gap-2">
                    <a href="{{ route('products.show', $product->id) }}" class="bg-green-500 text-white px-3 py-1 rounded flex-1 text-center">View</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded flex-1 text-center">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete permanently? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded w-full">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No products found. <a href="{{ route('products.create') }}" class="text-blue-500">Create one</a></p>
        @endforelse
    </div>
</div>
@endsection

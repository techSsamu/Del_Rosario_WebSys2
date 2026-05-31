@extends('app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Product</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="bg-white rounded-lg shadow-md p-6 max-w-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Product Name</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-6">
            <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ $product->price }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection

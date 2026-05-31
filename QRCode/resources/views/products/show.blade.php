@extends('app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl">
        <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-gray-600 text-lg mb-6">Price: ${{ $product->price }}</p>

        @if($qr)
            <div class="mb-8 p-4 bg-gray-100 rounded text-center">
                <p class="text-gray-600 mb-4">Product QR Code:</p>
                {!! $qr !!}
            </div>
            <div class="mb-8 text-center">
                <a href="{{ asset($qrImagePath) }}" download class="bg-green-500 text-white px-4 py-2 rounded">
                    Download QR Code as {{ strtoupper(pathinfo($qrImagePath, PATHINFO_EXTENSION)) }}
                </a>
            </div>
        @endif

        <p class="text-sm text-red-600 mb-4">Deleting this product is permanent and cannot be undone.</p>
        <div class="flex gap-2">
            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete permanently? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
            </form>
            <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
        </div>
    </div>
</div>
@endsection

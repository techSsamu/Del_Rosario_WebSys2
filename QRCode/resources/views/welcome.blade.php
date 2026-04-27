@extends('app')

@section('content')
<div class="text-center py-20">
    <h1 class="text-4xl font-bold mb-4">Welcome to QR Product System</h1>
    <p class="text-lg mb-8">Manage your products with QR codes.</p>
    <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg text-lg">View Products</a>
</div>
@endsection
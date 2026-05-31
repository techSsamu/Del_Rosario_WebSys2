@extends('layouts.master')

@section('title', 'About Page')
@section('content')
<h1>Welcome to About Page</h1>
<p>This page also extends the same master layout.</p>
<button>Submit mo beybe</button>
@endsection

@push('scripts')
<script>
    console.log('Custom Script')
</script>
@endpush

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @stack('styles')
</head>
<body>
    @include('partials.navbar')
    <div class="container mt-4">
    @yield('content')
</div>

    @include('partials.footer')
    @stack ('scripts')
</body>
</html>

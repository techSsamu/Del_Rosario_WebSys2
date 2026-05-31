<!DOCTYPE html>
<html>
<head>
<title>QR Product System</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>
body {
    background: #f4f6f9;
}

.card {
    border-radius: 12px;
}

.btn {
    border-radius: 8px;
}
</style>

</head>

<body class="bg-gray-100">

<nav class="bg-gray-800 text-white p-4 mb-4">
    <div class="container mx-auto">
        <h1 class="text-xl font-bold">QR Product System</h1>
    </div>
</nav>

<div class="container mx-auto">
    @yield('content')
</div>

</body>
</html>
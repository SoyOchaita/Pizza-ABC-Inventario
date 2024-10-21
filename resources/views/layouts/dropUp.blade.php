<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'McDonalds')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-800 text-white font-sans">

    <!-- Contenido Principal -->
    <div class="container mx-auto py-8">
        @yield('content')
    </div>

    <!-- Scripts de Vite -->
    @vite('resources/js/app.js')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'McDonalds')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white font-sans">
    <!-- Barra de Navegación Superior -->
    <nav class="bg-stone-800 text-white py-3">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex justify-start items-center">
                <!-- Ícono de Inicio -->
                <a href="#" class="flex items-center ml-6">
                    <img src="/images/home-icon.png" alt="Inicio" class="h-6 w-6 mr-2">
                    <span class="text-xl">Inicio</span>
                </a>
                <!-- Ícono de Menú -->
                <a href="#" class="flex items-center ml-6">
                    <img src="/images/menu-icon.png" alt="Menú" class="h-6 w-6 mr-2">
                    <span class="text-xl">Menú</span>
                </a>
                <!-- Ícono de Más -->
                <a href="#" class="flex items-center ml-6">
                    <img src="/images/more-icon.png" alt="Más" class="h-6 w-6 mr-2">
                    <span class="text-xl">Más</span>
                </a>
            </div>

            <!-- Botón de Cerrar sesión solo si está autenticado -->
            @if (Auth::check())
                <form method="POST" action="{{ route('logout') }}" class="mr-6">
                    @csrf
                    <button type="submit" class="bg-yellow-400 text-black font-bold px-6 py-2 rounded-full shadow-md">
                        Cerrar sesión
                    </button>
                </form>
            @endif
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container mx-auto py-8">
        @yield('content')
    </div>

    <!-- Scripts de Vite -->
    @vite('resources/js/app.js')
</body>
</html>

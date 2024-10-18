<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'McDonalds')</title>

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
</head>
<body class="bg-black text-white">

    <!-- Encabezado -->
    <header class="bg-red-600 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold">Hola, Nombre</h1>
            <span>Bienvenido a McDonald's</span>
        </div>
    </header>

    <!-- Banner Promocional (Carrusel) -->
    <section class="bg-gray-800 py-10">
        <div class="container mx-auto">
            <div class="relative">
                <div class="flex overflow-hidden">
                    <!-- Imagenes del banner -->
                    <img src="/images/promo1.jpg" class="w-full h-64 object-cover">
                    <img src="/images/promo2.jpg" class="w-full h-64 object-cover">
                    <!-- Agrega más imágenes de promociones según sea necesario -->
                </div>
                <div class="absolute bottom-0 left-0 w-full text-center">
                    <span class="inline-block bg-white w-3 h-3 rounded-full mx-1"></span>
                    <span class="inline-block bg-gray-400 w-3 h-3 rounded-full mx-1"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Botones de acción -->
    <section class="py-10">
        <div class="container mx-auto text-center">
            <button class="bg-yellow-500 text-black font-bold py-2 px-4 rounded-lg mx-2">
                Pedir ahora
            </button>
            <button class="bg-green-500 text-black font-bold py-2 px-4 rounded-lg mx-2">
                Programar mi pedido
            </button>
        </div>
    </section>

    <!-- Historial de pedidos -->
    <section class="py-10 bg-gray-800">
        <div class="container mx-auto text-center">
            <button class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg">
                Últimos pedidos
            </button>
            <p class="mt-4 text-sm text-gray-400">Ver más pedidos anteriores</p>
        </div>
    </section>

    <!-- Barra de Navegación Inferior -->
    <nav class="fixed bottom-0 w-full bg-gray-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="flex flex-col items-center">
                <span class="text-xl">🏠</span>
                <span>Inicio</span>
            </a>
            <a href="#" class="flex flex-col items-center">
                <span class="text-xl">🍔</span>
                <span>Menú</span>
            </a>
            <a href="#" class="flex flex-col items-center">
                <span class="text-xl">⚙️</span>
                <span>Más</span>
            </a>
        </div>
    </nav>

    <!-- Scripts de Vite -->
    @vite('resources/js/app.js')
</body>
</html>

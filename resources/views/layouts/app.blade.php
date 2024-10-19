<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'McDonalds')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-stone-800 text-white font-sans">

        <!-- Barra de Navegación Superior -->
<nav class="bg-stone-800 text-white py-3">
    <div class="container mx-auto flex justify-start items-center">
        <!-- Ícono de Inicio -->
        <a href="#" class="flex items-center ml-6">
            <img src="/images/home-icon.png" alt="Inicio" class="h-6 w-6 mr-2"> <!-- Asegúrate de ajustar la ruta a la imagen -->
            <span class="text-xl">Inicio</span>
        </a>
        <!-- Ícono de Menú -->
        <a href="#" class="flex items-center ml-6">
            <img src="/images/menu-icon.png" alt="Menú" class="h-6 w-6 mr-2"> <!-- Asegúrate de ajustar la ruta a la imagen -->
            <span class="text-xl">Menú</span>
        </a>
        <!-- Ícono de Más -->
        <a href="#" class="flex items-center ml-6">
            <img src="/images/more-icon.png" alt="Más" class="h-6 w-6 mr-2"> <!-- Asegúrate de ajustar la ruta a la imagen -->
            <span class="text-xl">Más</span>
        </a>
    </div>
</nav>




            <!-- Encabezado -->
    <header class="bg-stone-900 py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold font-extrabold">Hola, Alfonso</h1>
                <h2 class="text-m font-bold">Bienvenido a McDonald's</h2>
            </div>
            <div class="bg-white rounded-full flex justify-center items-center" style="width: 52px; height: 52px;">
                <img src="/images/mcdonalds-logo.png" alt="McDonald's Logo" class="h-14 w-14 rounded-full object-cover">
            </div>
        </div>
    </header>


        <!-- Banner Promocional (Carrusel) -->
    <section class="bg-stone-900 py-5">
        <div class="container mx-auto rounded-lg overflow-hidden shadow-lg">
            <div class="flex overflow-hidden">
                <!-- Contenedor para cada imagen con bordes redondeados y margen -->
                <div class="mr-4 rounded-lg overflow-hidden">
                    <img src="/images/promo1.jpg" class="h-40 object-cover">
                </div>
                <div class="mr-4 rounded-lg overflow-hidden">
                    <img src="/images/promo2.jpg" class="h-40 object-cover">
                </div>
                <div class="rounded-lg overflow-hidden"> 
                    <img src="/images/promo3.jpg" class="h-40 object-cover">
                </div>
            </div>
        </div>
    </section>




        <!-- Botones de acción -->
    <section class="py-10 bg-stone-900">
        <div class="container mx-auto text-center">
            <!-- Texto Pregunta -->
            <h2 class="text-2xl font-bold text-white mb-6">¿Tienes hambre?</h2>
            <div class="flex justify-center space-x-4">
                <!-- Botón Pedir ahora -->
                <div class="rounded-lg overflow-hidden shadow-lg" style="width: 300px; height: 200px;">
                    <div class="bg-stone-800 flex flex-col items-center justify-center h-full">
                        <img src="/images/delivery.png" alt="Pedir ahora" class="h-24 mb-4">
                        <button class="bg-transparent text-white font-bold py-2">
                            Pedir ahora
                        </button>
                    </div>
                </div>
                
                <!-- Botón Encontrar sucursal -->
                <div class="rounded-lg overflow-hidden shadow-lg" style="width: 300px; height: 200px;">
                    <div class="bg-stone-800 flex flex-col items-center justify-center h-full">
                        <img src="/images/sucursal.png" alt="Encontrar sucursal" class="h-24 mb-4">
                        <button class="bg-transparent text-white font-bold py-2">
                            Encontrar sucursal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Último pedido -->
<section class="bg-stone-900 py-5">
    <div class="container mx-auto rounded-lg overflow-hidden shadow-lg">
        <!-- Título de la sección -->
        <div class="text-white py-2 px-4">
            <h2 class="text-xl font-bold">Últimos pedidos</h2>
            <p class="text-sm">Revisar tus pedidos anteriores</p>
        </div>
        <!-- Detalle del último pedido -->
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center">
                <img src="/images/big-tasty.jpg" alt="Big Tasty" class="h-24 w-24 mr-4 rounded-full">
                <div>
                    <h3 class="text-xl font-bold">Big Tasty™</h3>
                    <p class="text-white text-sm">Deliciosa hamburguesa en un pan con ajonjolí, con una torta 100% de res, cebolla...</p>
                    <p class="text-orange-500 font-bold">Q64.00</p>
                </div>
            </div>
            <button class="bg-yellow-500 text-black font-bold py-2 px-4 rounded-lg">
                Ver más
            </button>
        </div>
    </div>
</section>


    <!-- Scripts de Vite -->
    @vite('resources/js/app.js')
</body>
</html>

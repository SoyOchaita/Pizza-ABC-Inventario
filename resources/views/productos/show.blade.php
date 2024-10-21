<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle del Producto') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-10 relative">
        <!-- Ícono de regresar -->
        <a href="{{ route('productos.index') }}" class="absolute top-19 right-0 bg-yellow-400 text-gray-800 p-2 rounded-full">
            <img src="/images/previous.png" alt="Regresar" class="h-6 w-6"> <!-- Usa la imagen del ícono que subiste -->
        </a>

        <div class="bg-stone-800 p-6 rounded-lg flex">
            <!-- Imagen del producto -->
            <img src="{{ $producto->imagen }}" class="w-1/3 h-auto object-cover rounded-lg mb-4 mr-8" alt="{{ $producto->name }}">

            <div class="flex flex-col justify-between w-full">
                <div>
                    <h1 class="text-4xl font-bold">{{ $producto->name }}</h1> <!-- Tamaño aumentado -->
                    <p class="text-gray-400 mb-4 text-lg"><strong>Categoría:</strong> {{ $producto->category->name }}</p> <!-- Tamaño aumentado -->
                    <p class="text-gray-200 text-lg">{{ $producto->description }}</p> <!-- Tamaño aumentado -->
                    <p class="text-yellow-500 font-bold text-2xl mt-4" id="product-price">Q{{ $producto->price }}</p> <!-- Tamaño aumentado -->
                </div>

                <!-- Formulario para agregar al carrito -->
                <form action="{{ route('cart.add') }}" method="POST" id="cart-form" class="mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $producto->id }}">
                    <div class="flex justify-center items-center mt-6">
                        <!-- Botón para agregar al carrito con ícono minimalista -->
                        <button type="submit" class="bg-yellow-500 text-white py-4 px-10 rounded-lg flex items-center text-2xl font-bold">
                            <img src="/images/cart.png" alt="Carrito" class="h-8 w-8 mr-2"> <!-- Ícono de carrito -->
                            Añadir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

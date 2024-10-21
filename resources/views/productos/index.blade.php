<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comidas') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-10">
        <!-- Botones de Categoría -->
        <div class="flex space-x-4 mb-8 justify-center">
            <a href="{{ route('productos.index') }}" class="bg-yellow-400 text-black px-4 py-2 rounded-full font-bold">
                Todos
            </a>
            @foreach($categorias as $categoria)
                <a href="{{ route('productos.index', ['category_id' => $categoria->id]) }}"
                    class="bg-yellow-400 text-black px-4 py-2 rounded-full font-bold">
                    {{ $categoria->name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Lista de productos -->
            @foreach($productos as $producto)
                <div class="bg-stone-800 p-4 rounded-lg shadow-lg flex items-center h-56">
                            <!-- Imagen cuadrada del producto a la izquierda -->
                            <div class="w-48 h-34 mr-4">
                                <img src="{{ $producto->imagen }}" class="w-full h-full object-cover rounded-lg" alt="{{ $producto->name }}">
                            </div>

                            <!-- Detalles del producto a la derecha -->
                            <div class="flex flex-col justify-center">
                                <h3 class="text-lg font-semibold text-green-700">{{ $producto->name }}</h3>
                                <p class="text-gray-400">{{ Str::limit($producto->description, 50, '...') }}</p>
                                <p class="text-yellow-500 font-bold mt-2">Q{{ $producto->price }}</p>

                                <!-- Botón "Ver más" del mismo ancho que la imagen -->
                                <a href="{{ route('productos.show', $producto->id) }}" 
                                class="mt-2 bg-red-500 text-white py-2 px-4 rounded-lg text-center inline-block"
                                style="width: 6rem;"> <!-- Ajustamos el ancho del botón al de la imagen -->
                                    Ver más
                                </a>
                            </div>
                    </div>
            @endforeach
        </div>



    </div>
</x-app-layout>

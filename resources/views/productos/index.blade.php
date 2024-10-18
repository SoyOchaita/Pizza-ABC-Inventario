@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <section class="py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold text-center mb-8">Nuestros Productos</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($productos as $producto)
                    <div class="bg-gray-800 p-4 rounded-lg">
                        <img src="{{ $producto->imagen }}" class="w-full h-40 object-cover mb-4" alt="{{ $producto->nombre }}">
                        <h3 class="text-lg font-semibold">{{ $producto->nombre }}</h3>
                        <p class="text-gray-400">{{ $producto->descripcion }}</p>
                        <p class="text-yellow-500 font-bold mt-2">Q{{ $producto->precio }}</p>
                        <button class="mt-4 bg-red-500 text-white py-2 px-4 rounded-lg">Agregar al carrito</button>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

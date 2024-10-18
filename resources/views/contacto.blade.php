@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
    <section class="py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold text-center mb-8">Contáctanos</h2>
            <form action="{{ route('contacto.store') }}" method="POST" class="max-w-lg mx-auto bg-gray-800 p-6 rounded-lg">
                @csrf
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="w-full p-2 rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-2 rounded-lg bg-gray-700 text-white" required>
                </div>
                <div class="mb-4">
                    <label for="mensaje" class="block text-sm font-medium">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="4" class="w-full p-2 rounded-lg bg-gray-700 text-white" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg">Enviar</button>
            </form>
        </div>
    </section>
@endsection

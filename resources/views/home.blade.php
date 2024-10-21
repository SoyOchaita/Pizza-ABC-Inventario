@extends('layouts.guest')

@section('title', 'Bienvenido a McDonald\'s')

@section('content')
<div class="text-center">
    <h1 class="text-4xl font-bold mb-6">Bienvenido a McDonald's</h1>
    <p class="text-lg mb-4">Inicia sesión o regístrate para continuar.</p>

    <div class="flex justify-center space-x-4">
        <a href="{{ route('login') }}" class="bg-yellow-400 text-black font-bold px-6 py-2 rounded-full">
            Iniciar Sesión
        </a>
        <a href="{{ route('register') }}" class="bg-yellow-400 text-black font-bold px-6 py-2 rounded-full">
            Registrarse
        </a>
    </div>
</div>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 leading-tight">
            {{ __('McDonald´s') }}
        </h2>
        <p>Bienvenido, {{ Auth::user()->name }}!</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mostrar mensaje de éxito si existe en la sesión -->
            @if (session('success'))
                <div id="success-alert" class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-lg">
                    {{ session('success') }}
                </div>

                <script>
                    // Ocultar el mensaje después de 3 segundos
                    setTimeout(function() {
                        const alert = document.getElementById('success-alert');
                        if (alert) {
                            alert.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @endif
        </div>

        <!-- Sección '¿Tienes hambre?' -->
        <section class="py-10 bg-stone-900 mt-8">
            <div class="container mx-auto text-center">
                <!-- Texto Pregunta -->
                <h2 class="text-2xl font-bold text-white mb-6">¿Tienes hambre?</h2>
                <div class="flex justify-center space-x-4">
                    <!-- Botón Pedir ahora -->
                    <div class="rounded-lg overflow-hidden shadow-lg" style="width: 300px; height: 200px;">
                        <div class="bg-stone-800 flex flex-col items-center justify-center h-full">
                            <img src="/images/delivery.png" alt="Pedir ahora" class="h-24 mb-4">
                            @if(Auth::check())
                                <!-- Redirige a productos si está autenticado -->
                                <a href="{{ route('productos.index') }}">
                                    <button class="bg-transparent text-white font-bold py-2">
                                        Pedir ahora
                                    </button>
                                </a>
                            @else
                                <!-- Redirige a iniciar sesión si no está autenticado -->
                                <a href="{{ route('login') }}">
                                    <button class="bg-transparent text-white font-bold py-2">
                                        Pedir ahora (Iniciar Sesión)
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Botón Encontrar sucursal -->
                    <div class="rounded-lg overflow-hidden shadow-lg" style="width: 300px; height: 200px;">
                        <div class="bg-stone-800 flex flex-col items-center justify-center h-full">
                            <img src="/images/sucursal.png" alt="Encontrar sucursal" class="h-24 mb-4">
                            <a href="{{ route('sucursales.index') }}">
                                <button class="bg-transparent text-white font-bold py-2">
                                    Encontrar sucursal
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

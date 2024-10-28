<x-app-layout>
@guest
    <!-- Contenido para usuarios invitados -->
    <p>Bienvenido a nuestra página. Por favor, inicia sesión o regístrate.</p>
@endguest

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
                        <a href="{{ route('productos.index') }}">
                            <button class="bg-transparent text-white font-bold py-2">
                                Pedir ahora
                            </button>
                        </a>
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
</x-app-layout>

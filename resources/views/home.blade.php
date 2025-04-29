<x-app-layout>
    @guest
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
    @endguest

    @auth
        <!-- Botones de acción -->
        <section class="py-10 bg-stone-900">
            <div class="container mx-auto text-center">
                <h2 class="text-2xl font-bold text-white mb-6">¿Tienes hambre?</h2>
                <div class="flex justify-center space-x-4">
                    <div class="rounded-lg overflow-hidden shadow-lg" style="width: 300px; height: 200px;">
                        <div class="bg-stone-800 flex flex-col items-center justify-center h-full">
                            <img src="/images/delivery.png" alt="Pedir ahora" class="h-24 mb-4">
                            <a href="{{ route('productos.index') }}">
                                <button class="bg-transparent text-white font-bold py-2">Pedir ahora</button>
                            </a>
                        </div>
                    </div>
                    <div class="rounded-lg overflow-hidden shadow-lg" style="width: 300px; height: 200px;">
                        <div class="bg-stone-800 flex flex-col items-center justify-center h-full">
                            <img src="/images/sucursal.png" alt="Encontrar sucursal" class="h-24 mb-4">
                            <button class="bg-transparent text-white font-bold py-2">Encontrar sucursal</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth
</x-app-layout>

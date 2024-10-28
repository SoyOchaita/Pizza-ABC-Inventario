<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Mis Direcciones') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        @if(session('success'))
            <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($addresses && $addresses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                @foreach($addresses as $address)
                    <div class="bg-stone-800 p-4 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold text-white">{{ $address->name }}</h3>
                        <h3 class="text-xl font-bold text-white">{{ $address->address }}</h3>
                        <p class="text-gray-400">Latitud: {{ $address->latitude }}</p>
                        <p class="text-gray-400">Longitud: {{ $address->longitude }}</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('addresses.edit', $address->id) }}" class="bg-yellow-500 text-black px-4 py-2 rounded">
                                Editar
                            </a>
                            <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta dirección?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 mb-4">No tienes direcciones guardadas.</p>
        @endif

        <!-- Botón de agregar nueva dirección siempre visible -->
        <div class="text-center">
            <a href="{{ route('addresses.create') }}" class="bg-yellow-500 text-black px-4 py-2 rounded">
                Agregar Nueva Dirección
            </a>
        </div>
    </div>

    <!-- Script para ocultar el mensaje de éxito después de 3 segundos -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }
        });
    </script>
</x-app-layout>

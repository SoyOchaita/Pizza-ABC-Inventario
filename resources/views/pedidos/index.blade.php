<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 leading-tight">
            {{ __('Mis Pedidos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        @if($pedidos->count() > 0)
            @foreach($pedidos as $pedido)
                <div class="bg-stone-800 p-6 rounded-lg shadow-lg mb-6 border-l-4 border-yellow-500">
                    <div class="flex items-center mb-4">
                        <div class="bg-red-500 rounded-full h-12 w-12 flex items-center justify-center text-white font-bold">
                            #{{ $pedido->id }}
                        </div>
                        <h3 class="ml-4 text-2xl font-bold text-yellow-500">Pedido #{{ $pedido->id }}</h3>
                    </div>
                    <div class="text-white space-y-2">
                        <p><span class="font-semibold text-yellow-500">Estado:</span> {{ $pedido->estado }}</p>
                        <p><span class="font-semibold text-yellow-500">Método de Pago:</span> {{ $pedido->metodo_pago }}</p>
                        <p><span class="font-semibold text-yellow-500">Tipo de Entrega:</span> {{ $pedido->tipo_entrega }}</p>
                        @if($pedido->direccion)
                            <p><span class="font-semibold text-yellow-500">Dirección:</span> {{ $pedido->direccion->address }}</p>
                        @endif
                        @if($pedido->sucursal)
                            <p><span class="font-semibold text-yellow-500">Sucursal:</span> {{ $pedido->sucursal->name }}</p>
                        @endif
                        <p><span class="font-semibold text-yellow-500">Fecha del Pedido:</span> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500 text-center">No tienes pedidos.</p>
            <div class="flex justify-center mt-6">
                <a href="{{ route('productos.index') }}" class="bg-yellow-500 text-black font-bold py-2 px-4 rounded">
                    Ordena tu primer pedido
                </a>
            </div>
        @endif
    </div>
</x-app-layout>

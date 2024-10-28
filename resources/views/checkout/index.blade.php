<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-500 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        @if($cart && $cart->products->count() > 0)
            <div class="bg-stone-800 p-6 rounded-lg shadow-lg mb-8">
                <h3 class="text-2xl font-bold text-white mb-4">Resumen del Pedido</h3>
                @foreach($cart->products as $product)
                    <div class="flex items-center mb-6">
                        <img src="{{ $product->imagen }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded mr-6">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-white">{{ $product->name }}</h3>
                            <p class="text-white">Cantidad: {{ $product->pivot->quantity }}</p>
                            <p class="text-white">Precio Total: Q{{ number_format($product->price * $product->pivot->quantity, 2) }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="text-2xl font-bold text-white mt-6">
                    Total del Carrito: Q{{ number_format($cart->products->sum(function ($product) { return $product->price * $product->pivot->quantity; }), 2) }}
                </div>
            </div>

            <div class="bg-stone-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold text-white mb-4">Detalles de Envío y Pago</h3>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="text-white">Tipo de Entrega:</label>
                        <select name="tipo_entrega" class="w-full bg-stone-700 text-white p-2 rounded" onchange="toggleDeliveryOptions(this.value)">
                            <option value="envio">Envío a Dirección</option>
                            <option value="recoger">Recoger en Sucursal</option>
                        </select>
                    </div>

                    <div id="envio_direccion" class="mb-4">
                        <label class="text-white">Selecciona una Dirección:</label>
                        <select name="direccion_id" class="w-full bg-stone-700 text-white p-2 rounded">
                            @foreach($addresses as $address)
                                <option value="{{ $address->id }}">{{ $address->name }} - {{ $address->address }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="recoger_sucursal" class="mb-4 hidden">
                        <label class="text-white">Selecciona una Sucursal:</label>
                        <select name="sucursal_id" class="w-full bg-stone-700 text-white p-2 rounded">
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }} - {{ $branch->address }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="text-white">Método de Pago:</label>
                        <select name="metodo_pago" class="w-full bg-stone-700 text-white p-2 rounded">
                            <option value="tarjeta">Tarjeta de Crédito</option>
                            <option value="debito">Débito</option>
                            <option value="efectivo">Efectivo</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Confirmar Pedido
                    </button>
                </form>
            </div>
        @else
            <p class="text-gray-500">Tu carrito está vacío.</p>
        @endif
    </div>

    <script>
        function toggleDeliveryOptions(tipoEntrega) {
            document.getElementById('envio_direccion').classList.add('hidden');
            document.getElementById('recoger_sucursal').classList.add('hidden');

            if (tipoEntrega === 'envio') {
                document.getElementById('envio_direccion').classList.remove('hidden');
            } else if (tipoEntrega === 'recoger') {
                document.getElementById('recoger_sucursal').classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>

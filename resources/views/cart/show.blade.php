<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-8 text-white">Carrito de Compras</h1>

        @if($cart && $cart->products->count() > 0)
            <div class="bg-stone-800 p-6 rounded-lg shadow-lg">
                @foreach($cart->products as $product)
                    <div class="flex items-center mb-6 product-row" data-product-id="{{ $product->id }}">
                        <!-- Imagen del producto -->
                        <img src="{{ $product->imagen }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded mr-6">

                        <!-- Información del producto -->
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-white">{{ $product->name }}</h3>
                            <p class="text-white">Precio unitario: Q{{ number_format($product->price, 2) }}</p>
                            <div class="flex items-center mt-2">
                                <!-- Botón Decrementar -->
                                <button class="decrement-btn bg-yellow-500 text-black px-2 py-1 rounded-l">
                                    -
                                </button>
                                <!-- Cantidad -->
                                <input type="text" value="{{ $product->pivot->quantity }}" readonly class="quantity-input w-12 text-center bg-stone-700 text-white border-t border-b border-gray-600">
                                <!-- Botón Incrementar -->
                                <button class="increment-btn bg-yellow-500 text-black px-2 py-1 rounded-r">
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Precio Total del Producto -->
                        <div class="text-white text-xl">
                            Q<span class="total-price">{{ number_format($product->price * $product->pivot->quantity, 2) }}</span>
                        </div>

                        <!-- Botón Eliminar Producto -->
                        <div class="ml-6">
                            <form action="{{ route('cart.removeAll', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- Total y Botones de Acción -->
                <div class="mt-8 flex flex-col">
                    <div class="flex justify-between items-center">
                        <div class="text-2xl font-bold text-white">
                            Total: Q<span id="cart-total">{{ number_format($cart->products->sum(function ($product) { return $product->price * $product->pivot->quantity; }), 2) }}</span>
                        </div>
                        <div>
                            <a href="{{ route('productos.index') }}" class="bg-yellow-500 text-black px-4 py-2 rounded mr-4">
                                Buscar más productos
                            </a>
                        </div>
                    </div>

                    <!-- Botón para ir al checkout -->
                    <div class="mt-8">
                        <a href="{{ route('checkout.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Iniciar Compra
                        </a>
                    </div>
                </div>
            </div>
        @else
            <p class="text-gray-500">Tu carrito está vacío.</p>
        @endif
    </div>

    <!-- Scripts de JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productRows = document.querySelectorAll('.product-row');

            productRows.forEach(row => {
                const productId = row.getAttribute('data-product-id');
                const incrementBtn = row.querySelector('.increment-btn');
                const decrementBtn = row.querySelector('.decrement-btn');
                const quantityInput = row.querySelector('.quantity-input');
                const totalPriceElem = row.querySelector('.total-price');
                const cartTotalElem = document.getElementById('cart-total');

                incrementBtn.addEventListener('click', function() {
                    updateQuantity(productId, 'increment');
                });

                decrementBtn.addEventListener('click', function() {
                    updateQuantity(productId, 'decrement');
                });

                function updateQuantity(productId, action) {
                    fetch(`{{ url('/carrito') }}/${action}/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (data.removed) {
                                // Eliminar la fila del producto
                                row.remove();
                            } else {
                                // Actualizar la cantidad y el precio total
                                quantityInput.value = data.quantity;
                                totalPriceElem.textContent = parseFloat(data.totalPrice).toFixed(2);
                            }
                            // Actualizar el total del carrito
                            cartTotalElem.textContent = parseFloat(data.cartTotal).toFixed(2);

                            // Si no hay más productos, mostrar mensaje de carrito vacío
                            if (parseFloat(data.cartTotal) === 0) {
                                document.querySelector('.bg-stone-800').innerHTML = '<p class="text-gray-500">Tu carrito está vacío.</p>';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });
    </script>
</x-app-layout>

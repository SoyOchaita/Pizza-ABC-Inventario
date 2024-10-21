<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carrito de Compras') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-8">Carrito de Compras</h1>

        @if($cart && $cart->products->count() > 0)
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Producto</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Precio</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->products as $product)
                        <tr>
                            <td class="border px-4 py-2">{{ $product->name }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('cart.update', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $product->pivot->quantity }}" min="1" class="w-16 text-center">
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Actualizar</button>
                                </form>
                            </td>
                            <td class="border px-4 py-2">Q{{ $product->price }}</td>
                            <td class="border px-4 py-2">Q{{ $product->price * $product->pivot->quantity }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-8">
                <p class="text-xl">Total: Q{{ $cart->products->sum(function ($product) { return $product->price * $product->pivot->quantity; }) }}</p>
                <button class="bg-green-500 text-white px-4 py-2 rounded">Proceder al Pago</button>
            </div>
        @else
            <p class="text-gray-500">Tu carrito está vacío.</p>
        @endif
    </div>
</x-app-layout>

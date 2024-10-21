<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Pedido;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Agregar un producto al carrito
    public function addProduct(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
            'status' => 'activo'
        ]);

        // Comprobar si el producto ya está en el carrito
        $existingProduct = $cart->products()->where('product_id', $product->id)->first();

        if ($existingProduct) {
            // Actualizar la cantidad si ya existe
            $newQuantity = $existingProduct->pivot->quantity + ($request->quantity ?? 1);
            $cart->products()->updateExistingPivot($product->id, ['quantity' => $newQuantity]);
        } else {
            // Agregar nuevo producto si no está en el carrito
            $cart->products()->attach($product, ['quantity' => $request->quantity ?? 1]);
        }
        // Comprobar si el producto ya está en el carrito
        $existingProduct = $cart->products()->where('product_id', $product->id)->first();

        if ($existingProduct) {
            // Actualizar la cantidad si ya existe
            $newQuantity = $existingProduct->pivot->quantity + ($request->quantity ?? 1);
            $cart->products()->updateExistingPivot($product->id, ['quantity' => $newQuantity]);
        } else {
            // Agregar nuevo producto si no está en el carrito
            $cart->products()->attach($product, ['quantity' => $request->quantity ?? 1]);
        }

        return redirect()->route('cart.show');
    }

    // Mostrar el carrito actual
    public function show()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'activo')
            ->with('products')
            ->first();

        return view('cart.show', compact('cart'));
    }

    // Eliminar un producto del carrito
    public function removeProduct($productId)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'activo')
            ->first();

        $cart->products()->detach($productId);

        return redirect()->route('cart.show');
    }

    // Actualizar la cantidad de un producto en el carrito
    public function updateQuantity(Request $request, $productId)
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 'activo')->first();
        $newQuantity = max($request->quantity, 1); // Asegurar que la cantidad sea al menos 1
        $cart->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);

        return redirect()->route('cart.show');
    }

    // Método para calcular el total del carrito
    private function calculateCartTotal($cart)
    {
        return $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });
    }

    // Mostrar la página de checkout
    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'activo')
            ->with('products')
            ->first();

        $addresses = Auth::user()->addresses;
        $branches = Sucursal::all();

        return view('cart.checkout', compact('cart', 'addresses', 'branches'));
    }

    // Procesar la confirmación del pedido
    public function processCheckout(Request $request)
    {
        // Validar los datos del formulario de checkout
        $request->validate([
            'tipo_entrega' => 'required|string',
            'metodo_pago' => 'required|string',
            'direccion_id' => 'required_if:tipo_entrega,envio|nullable|exists:addresses,id',
            'sucursal_id' => 'required_if:tipo_entrega,recoger|nullable|exists:sucursales,id',
        ]);

        // Obtener el carrito del usuario actual
        $cart = Cart::where('user_id', Auth::id())->where('status', 'activo')->with('products')->first();

        if (!$cart || $cart->products->count() == 0) {
            return redirect()->route('cart.show')->with('error', 'Tu carrito está vacío.');
        }

        // Crear un pedido en la base de datos
        $pedido = Pedido::create([
            'user_id' => Auth::id(),
            'carrito_id' => $cart->id,
            'estado' => 'procesando',
            'metodo_pago' => $request->metodo_pago,
            'tipo_entrega' => $request->tipo_entrega,
            'direccion_id' => $request->direccion_id,
            'sucursal_id' => $request->sucursal_id,
        ]);

        // Cambiar el estado del carrito a "procesando"
        $cart->status = 'procesando';
        $cart->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido confirmado y en proceso.');
    }
}

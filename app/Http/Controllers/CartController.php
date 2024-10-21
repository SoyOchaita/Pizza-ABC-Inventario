<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
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

        return redirect()->route('cart.show');
    }

    // Mostrar el carrito actual
    public function show()
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 'activo')->with('products')->first();
        return view('cart.show', compact('cart'));
    }

    // Eliminar un producto del carrito
    public function removeProduct($productId)
    {
        $cart = Cart::where('user_id', Auth::id())->where('status', 'activo')->first();
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
}

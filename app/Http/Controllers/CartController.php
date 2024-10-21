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

        $cart->products()->attach($product, ['quantity' => $request->quantity ?? 1]);

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
        $cart->products()->updateExistingPivot($productId, ['quantity' => $request->quantity]);
        return redirect()->route('cart.show');
    }
}

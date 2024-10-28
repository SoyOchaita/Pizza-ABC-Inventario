<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pedido;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Mostrar la página de checkout
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'activo')
            ->with('products')
            ->first();

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Tu carrito está vacío.');
        }

        $addresses = Auth::user()->addresses;
        $branches = Sucursal::all();

        return view('checkout.index', compact('cart', 'addresses', 'branches'));
    }

    // Procesar la confirmación del pedido
    public function process(Request $request)
    {
        $request->validate([
            'tipo_entrega' => 'required|string',
            'metodo_pago' => 'required|string',
            'direccion_id' => 'required_if:tipo_entrega,envio|nullable|exists:addresses,id',
            'sucursal_id' => 'required_if:tipo_entrega,recoger|nullable|exists:sucursales,id',
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('status', 'activo')
            ->with('products')
            ->first();

        if (!$cart || $cart->products->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Tu carrito está vacío.');
        }

        // Crear el pedido en la base de datos
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

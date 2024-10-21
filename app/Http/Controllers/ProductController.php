<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    // Método para listar productos con filtro por categoría
    public function index(Request $request)
    {
        $categorias = Category::all(); // Obtener todas las categorías
        $productos = Product::with('category');

        // Si se selecciona una categoría, filtrar productos por esa categoría
        if ($request->category_id) {
            $productos = $productos->where('category_id', $request->category_id);
        }

        $productos = $productos->get();
        
        return view('productos.index', compact('productos', 'categorias'));
    }

    // Método para mostrar un producto específico
    public function show($id)
    {
        // Buscar el producto por su ID y cargar su categoría
        $producto = Product::with('category')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Mostrar carrito
    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('productos.cart', compact('cart'));
    }

    // Método para actualizar cantidad de productos en el carrito
    public function updateCart(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            // Aumentar o disminuir la cantidad dependiendo de la acción
            if ($request->action == 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action == 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
            Session::put('cart', $cart);
        }

        return response()->json(['cart' => $cart]);
    }

    // Método para eliminar un producto del carrito
    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return response()->json(['cart' => $cart]);
    }
}

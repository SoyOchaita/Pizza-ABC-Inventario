<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Método para listar todos los productos
    public function index()
    {
        $productos = Product::with('category')->get(); // Obtener productos con sus categorías
        return view('productos.index', compact('productos')); // Retornar la vista con los productos
    }

    // Método para mostrar los detalles de un producto específico
    public function show($id)
    {
        $producto = Product::findOrFail($id); // Buscar el producto por ID
        return view('productos.show', compact('producto')); // Retornar la vista con los detalles del producto
    }
}


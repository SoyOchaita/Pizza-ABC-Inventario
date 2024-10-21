<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
}

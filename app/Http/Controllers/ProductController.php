<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Método para listar productos
    public function index()
    {
        $productos = Product::with('category')->get();
        return view('productos.index', compact('productos'));
    }

    // Método para mostrar un producto específico
    public function show($id)
    {
        $producto = Product::findOrFail($id);
        return view('productos.show', compact('producto'));
    }
}

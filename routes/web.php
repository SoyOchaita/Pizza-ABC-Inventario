<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;

// Ruta principal ('/') que redirige al dashboard si el usuario ya está autenticado
Route::get('/', function () {
    // Si el usuario está autenticado, lo redirigimos al dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Si no está autenticado, mostramos la página de bienvenida (home.blade.php)
    return view('home');
});

// Ruta al dashboard después de iniciar sesión (protegida por auth)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rutas del profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del carrito

    // Rutas del carrito
    Route::post('/carrito/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::get('/carrito', [CartController::class, 'show'])->name('cart.show');
    Route::delete('/carrito/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::patch('/carrito/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');

    // Rutas de productos
    Route::get('productos', [ProductController::class, 'index'])->name('productos.index');
    Route::get('productos/{id}', [ProductController::class, 'show'])->name('productos.show');
});

require __DIR__.'/auth.php';

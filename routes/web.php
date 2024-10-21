<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/carrito/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::get('/carrito', [CartController::class, 'show'])->name('cart.show');
    Route::delete('/carrito/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::patch('/carrito/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
});
Route::get('productos', [ProductController::class, 'index'])->name('productos.index'); // Ruta para listar productos
Route::get('productos/{id}', [ProductController::class, 'show'])->name('productos.show'); // Ruta para mostrar detalles de un producto
require __DIR__.'/auth.php';

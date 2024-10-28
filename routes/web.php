<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Addresses\AddressController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;

// Ruta principal accesible para todos
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Ruta para cerrar sesión
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Rutas de productos (accesibles para todos)
Route::get('productos', [ProductController::class, 'index'])->name('productos.index');
Route::get('productos/{id}', [ProductController::class, 'show'])->name('productos.show');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {

    // Ruta al dashboard después de iniciar sesión (protegida por auth)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');    

    // Rutas del profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del carrito
    Route::post('/carrito/add', [CartController::class, 'addProduct'])->name('cart.add');
    Route::get('/carrito', [CartController::class, 'show'])->name('cart.show');
    Route::delete('/carrito/remove/{id}', [CartController::class, 'removeProduct'])->name('cart.remove');
    Route::patch('/carrito/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/carrito/increment/{id}', [CartController::class, 'incrementQuantity'])->name('cart.increment');
    Route::post('/carrito/decrement/{id}', [CartController::class, 'decrementQuantity'])->name('cart.decrement');
    Route::post('/carrito/remove-all/{id}', [CartController::class, 'removeAllOfProduct'])->name('cart.removeAll');

    // Rutas del checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index'); // Mostrar la página de checkout
    Route::post('/checkout/confirm', [CheckoutController::class, 'process'])->name('checkout.process'); // Procesar el pedido

    // Ruta de pedidos (mostrar todos los pedidos en contenedores)
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

    // Rutas de direcciones
    Route::prefix('addresses')->name('addresses.')->group(function () {
        Route::get('/', [AddressController::class, 'index'])->name('index');
        Route::get('/create', [AddressController::class, 'create'])->name('create');
        Route::post('/', [AddressController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AddressController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AddressController::class, 'update'])->name('update');
        Route::delete('/{id}', [AddressController::class, 'destroy'])->name('destroy');
    });

    // Rutas de sucursales
    Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales.index');

    Route::get('/contacto', [ContactController::class, 'create'])->name('contacto.create'); // Ruta para mostrar el formulario
    Route::post('/contacto', [ContactController::class, 'send'])->name('contacto.send'); // Ruta para enviar el formulario
});

// Rutas de Spotify
Route::post('/buscar-artista', [SpotifyController::class, 'buscarArtista'])->name('buscar.artista');
Route::post('/buscar-canción', [SpotifyController::class, 'buscarCancion'])->name('buscar.cancion');

Route::get('/buscar-artista', function () {
    return view('spotify');
})->name('form.artista');

require __DIR__.'/auth.php';

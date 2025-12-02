<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\CatalogoAdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\CompraAdminController;
use App\Http\Controllers\ReclamoAdminController;
use App\Http\Controllers\ContactoAdminController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

// --- AQUÍ ESTABA EL ERROR: Faltaban estas rutas del Footer ---
// Si no tienes los métodos en HomeController, usa Route::view o créalos.
// Por ahora asumo que existen en HomeController como en tu código original.
Route::get('/terminos-condiciones', [HomeController::class, 'terminos'])->name('terminos');
Route::get('/metodos-envio', [HomeController::class, 'metodosEnvio'])->name('metodos.envio');
Route::get('/politica-privacidad', [HomeController::class, 'politicaPrivacidad'])->name('politica.privacidad');

// Catálogo
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{producto}', [CatalogoController::class, 'show'])->name('catalogo.show');

// Formularios
Route::get('/contacto', [ContactoController::class, 'create'])->name('contacto.create');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');
Route::get('/reclamos', [ReclamoController::class, 'create'])->name('reclamos.create');
Route::post('/reclamos', [ReclamoController::class, 'store'])->name('reclamos.store');

// Carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/eliminar/{producto}', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::post('/carrito/actualizar/{producto}', [CarritoController::class, 'updateQuantity'])->name('carrito.updateQuantity');
Route::post('/carrito/vaciar', [CarritoController::class, 'clear'])->name('carrito.clear');

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('registro.show');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.store');
Route::get('/password/recuperar', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/recuperar', [AuthController::class, 'resetPassword'])->name('password.update');

/*
|--------------------------------------------------------------------------
| 2. RUTAS DE CLIENTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [CarritoController::class, 'procesarCompra'])->name('checkout.process');
    
    // Perfil
    Route::get('/mi-perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::put('/mi-perfil', [PerfilController::class, 'update'])->name('perfil.update');
    // Esta ruta es vital para la redirección después de comprar
    Route::get('/mi-perfil/compra/{id}', [PerfilController::class, 'detalleCompra'])->name('perfil.detalle');
});

/*
|--------------------------------------------------------------------------
| 3. RUTAS DE EMPLEADOS (ADMINISTRACIÓN)
|--------------------------------------------------------------------------
*/
Route::middleware(['empleado'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('empleados', EmpleadoController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('tallas', TallaController::class);
    
    // Compras Admin
    Route::get('compras-admin', [CompraAdminController::class, 'index'])->name('compras.index');
    // Ruta para cambiar estado (Aprobar/Rechazar)
    Route::put('compras-admin/{compra}/estado', [CompraAdminController::class, 'cambiarEstado'])->name('compras.cambiarEstado');
    
    Route::delete('compras-admin/{compra}', [CompraAdminController::class, 'destroy'])->name('compras.destroy');
    Route::get('/admin/compras/{compra}/pdf', [CompraAdminController::class, 'pdf'])->name('compras.pdf');

    Route::get('reclamos-admin', [ReclamoAdminController::class, 'index'])->name('reclamos.index');
    Route::delete('reclamos-admin/{reclamo}', [ReclamoAdminController::class, 'destroy'])->name('reclamos.destroy');

    Route::resource('contactos', ContactoAdminController::class)
        ->names('contactos')
        ->parameters(['contactos' => 'contacto']);

    Route::resource('catalogo-admin', CatalogoAdminController::class)
        ->parameters(['catalogo-admin' => 'producto'])
        ->names('catalogoAdmin');
});

    use App\Http\Controllers\ChatbotController; // Arriba con los imports

    Route::post('/chatbot/ask', [ChatbotController::class, 'chat']);
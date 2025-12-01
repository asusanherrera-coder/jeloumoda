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
| RUTAS PÚBLICAS (NO REQUIEREN LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

// Catálogo Público
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');
Route::get('/catalogo/{producto}', [CatalogoController::class, 'show'])->name('catalogo.show');

// Contacto Público
Route::get('/contacto', [ContactoController::class, 'create'])->name('contacto.create');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

// Reclamos Público
Route::get('/reclamos', [ReclamoController::class, 'create'])->name('reclamos.create');
Route::post('/reclamos', [ReclamoController::class, 'store'])->name('reclamos.store');

// Páginas legales
Route::get('/terminos-condiciones', [HomeController::class, 'terminos'])->name('terminos');
Route::get('/metodos-envio', [HomeController::class, 'metodosEnvio'])->name('metodos.envio');
Route::get('/politica-privacidad', [HomeController::class, 'politicaPrivacidad'])->name('politica.privacidad');

// Carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/eliminar/{producto}', [CarritoController::class, 'remove'])->name('carrito.remove');
Route::post('/carrito/actualizar/{producto}', [CarritoController::class, 'updateQuantity'])->name('carrito.updateQuantity');
Route::post('/carrito/vaciar', [CarritoController::class, 'clear'])->name('carrito.clear');

// Login / Registro / Recuperar
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/registro', [AuthController::class, 'showRegisterForm'])->name('registro.show');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.store');

Route::get('/password/recuperar', [AuthController::class, 'showResetForm'])->name('password.request');
Route::post('/password/recuperar', [AuthController::class, 'resetPassword'])->name('password.update');


/*
|--------------------------------------------------------------------------
| RUTAS QUE REQUIEREN LOGIN (CLIENTES)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CarritoController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [CarritoController::class, 'procesarCompra'])->name('checkout.process');
    Route::get('/perfil/{transactionId}', [PerfilController::class, 'recibo'])->name('perfil.recibo');
});


/*
|--------------------------------------------------------------------------
| RUTAS DE EMPLEADOS (PANEL DE CONTROL)
|--------------------------------------------------------------------------
*/

// 1. NIVEL BÁSICO: Accesible para TODOS los empleados (Vendedores, Almaceneros, Admins)
Route::middleware(['empleado'])->group(function () {

    // Dashboard General
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. NIVEL PROTEGIDO: Accesible SOLO para Administradores
    // Aquí es donde estaban faltando las rutas
    Route::middleware(['admin'])->group(function () {

        // Gestión de Empleados
        Route::resource('empleados', EmpleadoController::class);

        // Gestión de Compras
        Route::get('compras-admin', [CompraAdminController::class, 'index'])->name('compras.index');
        Route::delete('compras-admin/{compra}', [CompraAdminController::class, 'destroy'])->name('compras.destroy');
        Route::get('/admin/compras/{compra}/pdf', [CompraAdminController::class, 'pdf'])->name('compras.pdf');

        // Gestión de Clientes y Tallas
        Route::resource('clientes', ClienteController::class);
        Route::resource('tallas', TallaController::class);

        // Contactos (LA RUTA QUE FALTABA)
        Route::resource('contactos', ContactoAdminController::class)
            ->names('contactos')
            ->parameters(['contactos' => 'contacto']);

        // Reclamos Admin
        Route::get('reclamos-admin', [ReclamoAdminController::class, 'index'])->name('reclamos.index');
        Route::delete('reclamos-admin/{reclamo}', [ReclamoAdminController::class, 'destroy'])->name('reclamos.destroy');

        // Catálogo Admin (Productos)
        Route::resource('catalogo-admin', CatalogoAdminController::class)
            ->parameters(['catalogo-admin' => 'producto'])
            ->names('catalogoAdmin');
    });

});
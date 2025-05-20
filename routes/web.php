<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas protegidas
Route::middleware('auth')->group(function () {
    // Home
    Route::get('/', function () {
        return view('home', ["breadcrumbs" => []]);
    })->name('home');

    // ==================== RUTAS PARA SERVICIOS ====================
    Route::prefix('catalogos/servicios')->group(function() {
        Route::get('/', [CatalogosController::class, 'servicios'])->name('catalogos.servicios');
        Route::get('/create', [CatalogosController::class, 'servicioscreate'])->name('catalogos.servicios.create');
        Route::post('/store', [CatalogosController::class, 'store'])->name('catalogos.servicios.store');
        Route::get('/{id}/edit', [CatalogosController::class, 'editServicio'])->name('catalogos.servicios.edit');
        Route::put('/{id}', [CatalogosController::class, 'updateServicio'])->name('catalogos.servicios.update');
        Route::delete('/{id}', [CatalogosController::class, 'destroyServicio'])->name('catalogos.servicios.destroy');
    });

    // ==================== RUTAS PARA ACCESORIOS ====================
    Route::prefix('catalogos/accesorios')->group(function() {
        Route::get('/', [CatalogosController::class, 'accesorios'])->name('catalogos.accesorios');
        Route::get('/create', [CatalogosController::class, 'accesorioscreate'])->name('catalogos.accesorios.create');
        Route::post('/', [CatalogosController::class, 'storeAccesorio'])->name('catalogos.accesorios.store');
        Route::get('/{accesorio}/edit', [CatalogosController::class, 'editAccesorio'])->name('catalogos.accesorios.edit');
        Route::put('/{accesorio}', [CatalogosController::class, 'updateAccesorio'])->name('catalogos.accesorios.update');
        Route::delete('/{accesorio}', [CatalogosController::class, 'destroyAccesorio'])->name('catalogos.accesorios.destroy');
    });

    // ==================== RUTAS PARA VENTAS ====================
    Route::prefix('catalogos/ventas')->group(function () {
        Route::get('/', [VentaController::class, 'ventas'])->name('catalogos.ventas');
        Route::get('/ventas', [VentaController::class, 'ventas'])->name('catalogos.ventas.index');
        Route::get('/create', [VentaController::class, 'ventascreate'])->name('catalogos.ventas.create');
        Route::get('/create-existing', [VentaController::class, 'ventasCreateExisting'])->name('catalogos.ventas.create-existing');
        Route::post('/store', [VentaController::class, 'storeVenta'])->name('catalogos.ventas.store');
        
        // Detalles y edición
        Route::get('/{venta}/detalles', [VentaController::class, 'detallesVenta'])->name('catalogos.ventas.detalles');
        Route::get('/{venta}/edit', [VentaController::class, 'editVenta'])->name('catalogos.ventas.edit');
        Route::put('/{venta}', [VentaController::class, 'updateVenta'])->name('catalogos.ventas.update');
        
        // Eliminación y cambio de estado
        Route::delete('/{venta}', [VentaController::class, 'destroyVenta'])->name('catalogos.ventas.destroy');
        Route::post('/{venta}/cambiar-estado', [VentaController::class, 'cambiarEstado'])->name('catalogos.ventas.cambiar-estado');
        Route::put('/{venta}/activate', [VentaController::class, 'activateVenta'])->name('catalogos.ventas.activate');
        Route::put('/{venta}/deactivate', [VentaController::class, 'deactivateVenta'])->name('catalogos.ventas.deactivate');
        
        // Reportes (opcional, podrían estar en otro grupo)
        Route::get('/reporte', [VentaController::class, 'reporteVentas'])->name('catalogos.ventas.reporte');
    });

    // ==================== RUTAS PARA REPORTES ====================
    Route::prefix('reportes')->group(function () {
        Route::get('/', [ReportesController::class, 'reportesGet'])->name('reportes');
        Route::get('/ventas', [ReportesController::class, 'reporteVentasGet'])->name('reportes.ventas');
        Route::get('/servicios', [ReportesController::class, 'reporteServiciosGet'])->name('reportes.servicios');
        Route::get('/productos', [ReportesController::class, 'reporteProductosGet'])->name('reportes.productos');
    });
});

// ==================== RUTAS PARA API ====================
Route::get('/api/accesorios/buscar', [CatalogosController::class, 'buscarAccesorio']);
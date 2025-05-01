<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('home', ["breadcrumbs" => []]);
})->name('home');

// Servicios
Route::prefix('catalogos/servicios')->group(function() {
    Route::get('/', [CatalogosController::class, 'servicios'])->name('catalogos.servicios');
    Route::get('/create', [CatalogosController::class, 'servicioscreate'])->name('catalogos.servicios.create');
    Route::post('/store', [CatalogosController::class, 'store'])->name('catalogos.servicios.store');
    Route::get('/{id}/edit', [CatalogosController::class, 'editServicio'])->name('catalogos.servicios.edit');
    Route::put('/{id}', [CatalogosController::class, 'updateServicio'])->name('catalogos.servicios.update');
    Route::delete('/{id}', [CatalogosController::class, 'destroyServicio'])->name('catalogos.servicios.destroy');
});

// Accesorios
Route::prefix('catalogos/accesorios')->group(function() {
    Route::get('/', [CatalogosController::class, 'accesorios'])->name('catalogos.accesorios');
    Route::get('/create', [CatalogosController::class, 'accesorioscreate'])->name('catalogos.accesorios.create');
    Route::post('/', [CatalogosController::class, 'storeAccesorio'])->name('catalogos.accesorios.store');
    Route::get('/{accesorio}/edit', [CatalogosController::class, 'editAccesorio'])->name('catalogos.accesorios.edit');
    Route::put('/{accesorio}', [CatalogosController::class, 'updateAccesorio'])->name('catalogos.accesorios.update');
    Route::delete('/{accesorio}', [CatalogosController::class, 'destroyAccesorio'])->name('catalogos.accesorios.destroy');
});

// Ventas
Route::prefix('catalogos/ventas')->group(function() {
    Route::get('/', [CatalogosController::class, 'ventas'])->name('catalogos.ventas.index');
    Route::get('/create', [CatalogosController::class, 'ventascreate'])->name('catalogos.ventas.create');
    Route::get('/create-existing', [CatalogosController::class, 'ventasCreateExisting'])->name('catalogos.ventas.create-existing');
    Route::post('/store', [CatalogosController::class, 'storeVenta'])->name('catalogos.ventas.store');
    Route::get('/{id}/detalles', [CatalogosController::class, 'detallesVenta'])->name('catalogos.ventas.detalles');
    Route::get('/{id}/edit', [CatalogosController::class, 'editVenta'])->name('catalogos.ventas.edit');
    Route::put('/{id}', [CatalogosController::class, 'updateVenta'])->name('catalogos.ventas.update');
    Route::delete('/{id}', [CatalogosController::class, 'destroyVenta'])->name('catalogos.ventas.destroy');
    
    // Rutas para gestión de estado
    Route::post('/{venta}/cambiar-estado', [CatalogosController::class, 'cambiarEstado'])
         ->name('ventas.cambiar-estado');
    Route::put('/{id}/activate', [CatalogosController::class, 'activateVenta'])->name('catalogos.ventas.activar');
    Route::put('/{id}/deactivate', [CatalogosController::class, 'deactivateVenta'])->name('catalogos.ventas.desactivar');
});

// Reportes
Route::prefix('reportes')->group(function() {
    Route::get('/', [ReportesController::class, 'reportesGet'])->name('reportes');
    Route::get('/ventas', [ReportesController::class, 'reporteVentasGet'])->name('reportes.ventas');
    Route::get('/servicios', [ReportesController::class, 'reporteServiciosGet'])->name('reportes.servicios');
    Route::get('/inventario', [ReportesController::class, 'reporteInventarioGet'])->name('reportes.inventario');
});
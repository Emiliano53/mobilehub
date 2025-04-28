<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\ReportesController; 

Route::get('/', function () {
    return view('home',["breadcrumbs"=>[]]);
});

// Servicios
Route::get('/catalogos/servicios', [CatalogosController::class, 'servicios'])->name('catalogos.servicios');
Route::get('/catalogos/servicios/create', [CatalogosController::class, 'servicioscreate'])->name('catalogos.servicios.create');
Route::get('/catalogos/servicios/{id}/edit', [CatalogosController::class, 'edit'])->name('catalogos.servicios.edit');
Route::put('/catalogos/servicios/{id}', [CatalogosController::class, 'update'])->name('catalogos.servicios.update');
Route::post('/catalogos/servicios/store', [CatalogosController::class, 'store'])->name('catalogos.servicios.store');
Route::delete('/catalogos/servicios/{id}', [CatalogosController::class, 'destroy'])->name('catalogos.servicios.destroy');

// Accesorios
Route::get('/catalogos/accesorios', [CatalogosController::class, 'accesorios'])->name('catalogos.accesorios');
Route::get('/catalogos/accesorios/create', [CatalogosController::class, 'accesorioscreate'])->name('catalogos.accesorios.create');
Route::get('/catalogos/accesorios/{id}/edit', [CatalogosController::class, 'editAccesorio'])->name('catalogos.accesorios.edit');
Route::post('/catalogos/accesorios/store', [CatalogosController::class, 'storeAccesorio'])->name('catalogos.accesorios.store');
Route::put('/catalogos/accesorios/{id}', [CatalogosController::class, 'updateAccesorio'])->name('catalogos.accesorios.update');
Route::delete('/catalogos/accesorios/{id}', [CatalogosController::class, 'destroyAccesorio'])->name('catalogos.accesorios.destroy');

// Ventas
Route::get('/catalogos/ventas', [CatalogosController::class, 'ventas'])->name('catalogos.ventas');
Route::get('/catalogos/ventas/create', [CatalogosController::class, 'ventascreate'])->name('catalogos.ventas.create');
Route::post('/catalogos/ventas/store', [CatalogosController::class, 'storeVenta'])->name('catalogos.ventas.store');
Route::get('/catalogos/ventas/{id}/edit', [CatalogosController::class, 'editVenta'])->name('catalogos.ventas.edit');
Route::put('/catalogos/ventas/{id}', [CatalogosController::class, 'updateVenta'])->name('catalogos.ventas.update');
Route::delete('/catalogos/ventas/{id}', [CatalogosController::class, 'destroyVenta'])->name('catalogos.ventas.delete');

// Reportes
Route::get('/reportes', [ReportesController::class, 'reportesGet'])->name('reportes');
Route::get('/reportes/ventas', [ReportesController::class, 'reporteVentasGet'])->name('reportes.ventas');
Route::get('/reportes/servicios', [ReportesController::class, 'reporteServiciosGet'])->name('reportes.servicios');
Route::get('/reportes/inventario', [ReportesController::class, 'reporteInventarioGet'])->name('reportes.inventario');
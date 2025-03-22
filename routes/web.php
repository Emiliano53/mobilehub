<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;

Route::get('/', function () {
    return view('home',["breadcrumbs"=>[]]);
});

Route::get('/catalogos/servicios', [CatalogosController::class, 'servicios'])->name('catalogos.servicios');
Route::get('/catalogos/servicios/create', [CatalogosController::class, 'servicioscreate'])->name('catalogos.servicios.create');
Route::get('/catalogos/servicios/{id}/edit', [CatalogosController::class, 'edit'])->name('catalogos.servicios.edit');
Route::delete('/catalogos/servicios/{id}', [CatalogosController::class, 'destroy'])->name('catalogos.servicios.destroy');
Route::get('/catalogos/accesorios', [CatalogosController::class, 'accesorios'])->name('catalogos.accesorios');
Route::get('/catalogos/accesorios/create', [CatalogosController::class, 'accesorioscreate'])->name('catalogos.accesorios.create');
Route::get('/catalogos/accesorios/{id}/edit', [CatalogosController::class, 'editAccesorio'])->name('catalogos.accesorios.edit');
Route::get('/catalogos/ventas', [CatalogosController::class, 'ventas'])->name('catalogos.ventas');
Route::get('/catalogos/ventas/create', [CatalogosController::class, 'ventascreate'])->name('catalogos.ventas.create');
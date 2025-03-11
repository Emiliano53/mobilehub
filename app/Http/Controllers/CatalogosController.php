<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Servicio;
use App\Models\Accesorio;
use App\Models\Venta;
Use DateTime;

class CatalogosController extends Controller
{
    public function home():View
    {
        return view('home',["breadcrumbs"=>[]]);
    }

    public function servicios(): View
    {
        $servicios = Servicio::all();
        return view('catalogos.servicios', [
            'servicios' => $servicios,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "servicios" => url("/catalogos/servicios")
            ]
        ]);
        
    }
    public function servicioscreate(): View
{
    $servicios = Servicio::all();
    return view('catalogos.servicios', [
        'servicios' => $servicios,
        "breadcrumbs" => [
            "inicio" => url("/"),
            "servicios" => url("/catalogos/servicios"), 
            "agregar" => url("/catalogos/servicios/create")
        ]
    ]);
}

    public function accesorios(): View
    {
        $accesorios = Accesorio::all();
        return view('catalogos.accesorios', [
            'accesorios' => $accesorios,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "accesorios" => url("/catalogos/accesorios")
            ]
        ]);
    }
    public function accesorioscreate(): View
    {
        $accesorios = Accesorio::all();
        return view('catalogos.accesorios', [
            'accesorios' => $accesorios,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "accesorios" => url("/catalogos/accesorios"),
                "agregar" => url("/catalogos/accesorios/create")
            ]
        ]);
    }

    public function ventas(): View
    {
        $ventas = Venta::all();
        return view('catalogos.ventas', [
            'ventas' => $ventas,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "ventas" => url("/catalogos/ventas")
            ]
        ]);
    }
    public function ventascreate(): View
    {
        $ventas = Venta::all();
        return view('catalogos.ventas', [
            'ventas' => $ventas,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "ventas" => url("/catalogos/ventas"),
                "agregar" => url("/catalogos/ventas/create")
            ]
        ]);
    }


}
<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Servicio;
use App\Models\Accesorio;
use Illuminate\View\View;

class ReportesController extends Controller
{
    public function reportesGet(): View
    {
        return view('reportes.reportes', [
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/reportes'),
            ],
        ]);
    }

/*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Devuelve una vista que muestra un reporte de ventas, con las ventas
     * ordenadas por fecha descendiente, y cada venta con sus accesorios.
     *
     * @return View
     */
/*******  3a9ef487-5c6e-4bf1-905e-207e0602da6a  *******/    public function reporteVentasGet(): View
    {
        $ventas = Venta::with('accesorios')->orderBy('fecha', 'DESC')->get();
        return view('reportes.ventas', [
            'ventas' => $ventas,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/reportes'),
                'Reporte de Ventas' => url('/reportes/ventas'),
            ],
        ]);
    }

    public function reporteServiciosGet(): View
    {
        $servicios = Servicio::orderBy('id', 'DESC')->get(); // Ordenar por ID descendente (el más reciente primero)
        return view('reportes.servicios', [
            'servicios' => $servicios,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/reportes'),
                'Reporte de Servicios' => url('/reportes/servicios'),
            ],
        ]);
    }

    public function reporteInventarioGet(): View
    {
        $inventario = Accesorio::all();
        return view('reportes.inventario', [
            'inventario' => $inventario,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/reportes'),
                'Reporte de Inventario' => url('/reportes/inventario'),
            ],
        ]);
    }
}
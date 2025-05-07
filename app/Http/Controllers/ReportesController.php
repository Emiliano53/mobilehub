<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Servicio;
use App\Models\Accesorio;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function reportesGet(Request $request): View
    {
        $query = Venta::with(['cliente', 'accesorios', 'servicios'])->orderBy('fecha', 'DESC');

        // Aplicar filtro por rango de fechas si se proporciona
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        }

        // Obtener los resultados paginados
        $ventas = $query->paginate(10);

        // Pasar la variable $ventas a la vista
        return view('reportes.reportesventas', [
            'ventas' => $ventas,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Reportes' => url('/reportes'),
            ],
        ]);
    }

    public function reporteVentasGet(Request $request): View
    {
        $query = Venta::with(['cliente', 'accesorios', 'servicios'])->orderBy('fecha', 'DESC');

        // Aplicar filtro por rango de fechas si se proporciona
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        }

        // Obtener los resultados paginados
        $ventas = $query->paginate(10);

        // Pasar la variable $ventas a la vista
        return view('reportes.reportesventas', [
            'ventas' => $ventas,
        ]);
    }

    public function reporteServiciosGet(): View
    {
        $servicios = Servicio::orderBy('id_servicio', 'DESC')->get(); // Cambia 'id' por 'id_servicio'

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
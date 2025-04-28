<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Accesorio;
use App\Models\Cliente;
use App\Models\Venta;

class CatalogosController extends Controller
{
    public function home(): View
    {
        return view('home', ["breadcrumbs" => []]);
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
        return view('catalogos.servicios_create', [
            "breadcrumbs" => [
                "inicio" => url("/"),
                "servicios" => url("/catalogos/servicios"), 
                "agregar" => url("/catalogos/servicios/create")
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'estado' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
        ]);

        $servicio = new Servicio();
        $servicio->descripcion_servicio = $request->input('descripcion');
        $servicio->estado = $request->input('estado');
        $servicio->costo = $request->input('precio');
        $servicio->save();

        return redirect('/catalogos/servicios')->with('success', 'Servicio guardado exitosamente!');
    }

    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('catalogos.servicios_edit', [
            'servicio' => $servicio,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "servicios" => url("/catalogos/servicios"),
                "editar" => url("/catalogos/servicios/{$id}/edit")
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'estado' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->descripcion_servicio = $request->input('descripcion');
        $servicio->estado = $request->input('estado');
        $servicio->costo = $request->input('precio');
        $servicio->save();

        return redirect('/catalogos/servicios')->with('success', 'Servicio actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();
        return redirect('/catalogos/servicios')->with('success', 'Servicio eliminado exitosamente!');
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
        return view('catalogos.accesorios_create', [
            "breadcrumbs" => [
                "inicio" => url("/"),
                "accesorios" => url("/catalogos/accesorios"),
                "agregar" => url("/catalogos/accesorios/create")
            ]
        ]);
    }

    public function storeAccesorio(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'existencia' => 'required|integer|min:0',
        ]);

        $accesorio = new Accesorio();
        $accesorio->nombre = $request->input('nombre');
        $accesorio->tipo = $request->input('tipo');
        $accesorio->marca = $request->input('marca');
        $accesorio->precio = $request->input('precio');
        $accesorio->existencia = $request->input('existencia');
        $accesorio->save();

        return redirect('/catalogos/accesorios')->with('success', 'Accesorio guardado exitosamente!');
    }

    public function editAccesorio($id)
    {
        $accesorio = Accesorio::findOrFail($id);
        return view('catalogos.accesorios_edit', [
            'accesorio' => $accesorio,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "accesorios" => url("/catalogos/accesorios"),
                "editar" => url("/catalogos/accesorios/{$id}/edit")
            ]
        ]);
    }

    public function updateAccesorio(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'existencia' => 'required|integer|min:0',
        ]);

        $accesorio = Accesorio::findOrFail($id);
        $accesorio->nombre = $request->input('nombre');
        $accesorio->tipo = $request->input('tipo');
        $accesorio->marca = $request->input('marca');
        $accesorio->precio = $request->input('precio');
        $accesorio->existencia = $request->input('existencia');
        $accesorio->save();

        return redirect('/catalogos/accesorios')->with('success', 'Accesorio actualizado exitosamente!');
    }

    public function destroyAccesorio($id)
    {
        $accesorio = Accesorio::findOrFail($id);
        $accesorio->delete();
        return redirect('/catalogos/accesorios')->with('success', 'Accesorio eliminado exitosamente!');
    }

    public function ventas(): View
    {
        $ventas = Venta::with('cliente')->get();
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
        $clientes = Cliente::all();
        return view('catalogos.ventas_create', [
            'clientes' => $clientes,
            'breadcrumbs' => [
                'Inicio' => url('/'),
                'Ventas' => url('/catalogos/ventas'),
                'Registrar Venta' => url('/catalogos/ventas/create'),
            ],
        ]);
    }

    public function storeVenta(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        $venta = new Venta();
        $venta->cliente_id = $request->input('cliente_id');
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->save();

        return redirect('/catalogos/ventas')->with('success', 'Venta registrada exitosamente!');
    }

    public function editVenta($id)
    {
        $venta = Venta::with('cliente')->findOrFail($id);
        $clientes = Cliente::all();
        return view('catalogos.ventas_edit', [
            'venta' => $venta,
            'clientes' => $clientes,
            "breadcrumbs" => [
                "inicio" => url("/"),
                "ventas" => url("/catalogos/ventas"),
                "editar" => url("/catalogos/ventas/{$id}/edit")
            ]
        ]);
    }

    public function updateVenta(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        $venta = Venta::with('cliente')->findOrFail($id);
        $venta->cliente_id = $request->input('cliente_id');
        $venta->fecha = $request->input('fecha');
        $venta->total = $request->input('total');
        $venta->save();

        return redirect('/catalogos/ventas')->with('success', 'Venta actualizada exitosamente!');
    }

    public function destroyVenta($id)
    {
        $venta = Venta::with('cliente')->findOrFail($id);
        $venta->delete();
        return redirect('/catalogos/ventas')->with('success', 'Venta eliminada exitosamente!');
    }
}
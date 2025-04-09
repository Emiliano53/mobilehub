<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Servicio;
use App\Models\Accesorio;
use App\Models\Cliente;
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
    return view('catalogos.servicioscreate', [
        'servicios' => $servicios,
        "breadcrumbs" => [
            "inicio" => url("/"),
            "servicios" => url("/catalogos/servicios"), 
            "agregar" => url("/catalogos/servicios/create")
        ]
    ]);
}
public function store(\Illuminate\Http\Request $request)
    {
        // Aquí va la lógica para guardar el nuevo servicio

        // 1. Validar los datos del formulario (opcional)
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'estado' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
        ]);

        // 2. Crear una nueva instancia del modelo Servicio
        $servicio = new Servicio();
        $servicio->descripcion_servicio = $request->input('descripcion');
        $servicio->estado = $request->input('estado');
        $servicio->costo = $request->input('precio');

        // 3. Guardar el nuevo servicio en la base de datos
        $servicio->save();

        // 4. Redireccionar al usuario a alguna página (por ejemplo, la lista de servicios)
        return redirect('/catalogos/servicios')->with('success', 'Servicio guardado exitosamente!');
    }
    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id); // Busca el servicio por su ID o lanza una excepción si no se encuentra
        $breadcrumbs = [
            ['url' => '/', 'label' => 'Inicio'],
            ['url' => '/catalogos/servicios', 'label' => 'Servicios'],
            ['url' => '/catalogos/servicios/' . $id . '/edit', 'label' => 'Editar Servicio'],
        ];
        return view('catalogos.servicios.edit', compact('servicio', 'breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion_servicio' => 'required|string|max:255',
            'estado' => 'nullable|string|max:50',
            'costo' => 'required|numeric|min:0',
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->descripcion_servicio = $request->input('descripcion_servicio');
        $servicio->estado = $request->input('estado');
        $servicio->costo = $request->input('costo');
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
        $accesorios = Accesorio::all();
        return view('catalogos.accesorioscreate', [
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
    $clientes = Cliente::all(); // Obtener todos los clientes de la base de datos
    return view('catalogos.ventascreate', compact('clientes'), [ // Usar compact() para pasar $clientes
        "breadcrumbs" => [
            "inicio" => url("/"),
            "ventas" => url("/catalogos/ventas"),
            "agregar" => url("/catalogos/ventas/create")
        ]
    ]);
}


}
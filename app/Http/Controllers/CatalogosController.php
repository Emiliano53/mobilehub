<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Servicio;
use App\Models\Accesorio;
use App\Models\Cliente;
use App\Models\Venta;
use Carbon\Carbon;

class CatalogosController extends Controller
{
    // Método Home
    public function home(): View
    {
        return view('home', [
            "breadcrumbs" => []
        ]);
    }

    // ==================== MÉTODOS PARA SERVICIOS ====================
    public function servicios(): View
    {
        $servicios = Servicio::where('estado', 'Activo')->get(); // Filtrar solo los servicios activos

        return view('catalogos.servicios', [
            'servicios' => $servicios,
            "breadcrumbs" => [
                'Inicio' => route('home'),
                'Servicios' => null,
            ]
        ]);
    }

    public function servicioscreate(): View
    {
        return view('catalogos.servicios_create', [
            "breadcrumbs" => [
                'Inicio' => route('home'),
                'Servicios' => route('catalogos.servicios'),
                'Crear Servicio' => null
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'descripcion' => 'required|string|max:255',
            'estado' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
        ]);

        Servicio::create([
            'descripcion_servicio' => $validated['descripcion'],
            'estado' => $validated['estado'],
            'costo' => $validated['precio']
        ]);

        return redirect()->route('catalogos.servicios')
                        ->with('success', 'Servicio creado exitosamente');
    }

    public function editServicio($id): View
    {
        $servicio = Servicio::findOrFail($id);
        return view('catalogos.servicios_edit', [
            'servicio' => $servicio,
            "breadcrumbs" => [
                'Inicio' => route('home'),
                'Servicios' => route('catalogos.servicios'),
                'Editar Servicio' => null
            ]
        ]);
    }

    public function updateServicio(Request $request, $id)
    {
        $validated = $request->validate([
            'descripcion_servicio' => 'required|string|max:255',
            'costo' => 'required|numeric|min:0.01',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $servicio = Servicio::findOrFail($id);
        $servicio->update([
            'descripcion_servicio' => $validated['descripcion_servicio'],
            'costo' => $validated['costo'],
            'estado' => $validated['estado']
        ]);

        return redirect()->route('catalogos.servicios')
                        ->with('success', 'Servicio actualizado exitosamente');
    }

    public function destroyServicio($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect()->route('catalogos.servicios')
                        ->with('success', 'Servicio eliminado exitosamente');
    }

    // ==================== MÉTODOS PARA ACCESORIOS ====================
    public function accesorios(): View
    {
        $accesorios = Accesorio::where('estado', 1)->paginate(10); // Filtrar solo los accesorios activos

        return view('catalogos.accesorios', [
            'accesorios' => $accesorios,
            "breadcrumbs" => [
                'Inicio' => route('home'),
                'Accesorios' => null
            ]
        ]);
    }

    public function accesorioscreate(): View
    {
        return view('catalogos.accesorios_create', [
            "breadcrumbs" => [
                'Inicio' => route('home'),
                'Accesorios' => route('catalogos.accesorios'),
                'Crear Accesorio' => null
            ]
        ]);
    }

    public function storeAccesorio(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'existencia' => 'required|integer|min:0',
        ]);

        // Buscar accesorio existente
        $accesorio = Accesorio::where('nombre', $validated['nombre'])
                              ->where('tipo', $validated['tipo'])
                              ->where('marca', $validated['marca'])
                              ->first();

        if ($accesorio) {
            // Actualizar existencia
            $accesorio->increment('existencia', $validated['existencia']);
            $accesorio->update(['precio' => $validated['precio']]); // Opcional: Actualizar precio
            return redirect()->route('catalogos.accesorios')
                             ->with('success', 'Accesorio actualizado exitosamente');
        }

        // Crear nuevo accesorio si no existe
        Accesorio::create($validated);

        return redirect()->route('catalogos.accesorios')
                         ->with('success', 'Accesorio creado exitosamente');
    }

    public function editAccesorio(Accesorio $accesorio): View
    {
        return view('catalogos.accesorios_edit', [
            'accesorio' => $accesorio,
            "breadcrumbs" => [
                'Inicio' => route('home'),
                'Accesorios' => route('catalogos.accesorios'),
                'Editar Accesorio' => null
            ]
        ]);
    }

    public function updateAccesorio(Request $request, Accesorio $accesorio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'tipo' => 'required|string|max:50',
            'marca' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'existencia' => 'required|integer|min:0',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        $accesorio->update([
            ...$validated,
            'estado' => $validated['estado'] == 'Activo'
        ]);

        return redirect()->route('catalogos.accesorios')
                        ->with('success', 'Accesorio actualizado exitosamente');
    }

    public function destroyAccesorio(Accesorio $accesorio)
    {
        $accesorio->delete();
        return redirect()->route('catalogos.accesorios')
                        ->with('success', 'Accesorio eliminado exitosamente');
    }

    public function buscarAccesorio(Request $request)
    {
        $query = $request->query('query');
        $accesorios = Accesorio::where('nombre', 'like', "%$query%")
                               ->orWhere('tipo', 'like', "%$query%")
                               ->get();

        return response()->json($accesorios);
    }
}
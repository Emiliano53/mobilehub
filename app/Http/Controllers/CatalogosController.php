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

    // ==================== MÉTODOS PARA VENTAS ====================
    // Métodos específicos para Ventas
     public function ventas(Request $request): View
    {
        $query = Venta::with('cliente')->orderBy('fecha', 'desc');

        if ($request->has('search')) {
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->search . '%');
            });
        }

        $ventas = $query->paginate(10);

        return view('catalogos.ventas', [
            'ventas' => $ventas,
            'breadcrumbs' => [
                'Inicio' => route('home'),
                'Ventas' => null,
            ]
        ]);
    }

    public function ventascreate(): View
    {
        return view('catalogos.ventas_create', [
            'clientes' => Cliente::all(),
            'servicios' => Servicio::where('estado', 'Activo')->get(),
            'productos' => Accesorio::where('estado', 1)->get(),
            'breadcrumbs' => [
                'Inicio' => route('home'),
                'Ventas' => route('catalogos.ventas'),
                'Nueva Venta' => null
            ]
        ]);
    }

    public function ventasCreateExisting(): View
    {
        return view('catalogos.ventas_create_existing', [
            'clientes' => Cliente::all(),
            'servicios' => Servicio::where('estado', 'Activo')->get(),
            'productos' => Accesorio::where('estado', 1)->get(),
            'breadcrumbs' => [
                'Inicio' => route('home'),
                'Ventas' => route('catalogos.ventas'),
                'Nueva Venta (Cliente Existente)' => null
            ]
        ]);
    }

    public function storeVenta(Request $request)
    {
        \Log::info('Datos recibidos en storeVenta:', $request->all());

        $validated = $request->validate([
            'cliente_opcion' => 'required|in:nuevo,existente',
            'nombre' => 'required_if:cliente_opcion,nuevo|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'servicios' => 'nullable|array',
            'servicios.*.id' => 'required_with:servicios|exists:servicio,id_servicio',
            'servicios.*.cantidad' => 'required_with:servicios|integer|min:1',
            'productos' => 'nullable|array',
            'productos.*.id' => 'required_with:productos|exists:accesorios,id_accesorios',
            'productos.*.cantidad' => 'required_with:productos|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Manejo del cliente
            if ($validated['cliente_opcion'] === 'nuevo') {
                $cliente = Cliente::create([
                    'nombre' => $validated['nombre'],
                    'direccion' => $validated['direccion'] ?? null,
                    'telefono' => $validated['telefono'] ?? null,
                ]);
                $clienteId = $cliente->id_cliente;
            } else {
                $clienteId = $validated['cliente_id'];
            }

            // Crear la venta
            $venta = Venta::create([
                'fk_id_cliente' => $clienteId,
                'fecha' => $validated['fecha'],
                'total' => $validated['total'],
                'activo' => true
            ]);

            // Adjuntar servicios
            if (!empty($validated['servicios'])) {
                foreach ($validated['servicios'] as $servicio) {
                    $servicioModel = Servicio::find($servicio['id']);
                    $venta->servicios()->attach($servicio['id'], [
                        'precio_unitario' => $servicioModel->costo,
                        'cantidad' => $servicio['cantidad'],
                        'subtotal' => $servicioModel->costo * $servicio['cantidad']
                    ]);
                }
            }

            // Adjuntar productos
            if (!empty($validated['productos'])) {
                foreach ($validated['productos'] as $producto) {
                    $productoModel = Accesorio::find($producto['id']);
                    $venta->accesorios()->attach($producto['id'], [
                        'precio_unitario' => $productoModel->precio,
                        'cantidad' => $producto['cantidad'],
                        'subtotal' => $productoModel->precio * $producto['cantidad']
                    ]);

                    // Actualizar existencia
                    $productoModel->decrement('existencia', $producto['cantidad']);
                }
            }

            DB::commit();

            return redirect()->route('catalogos.ventas')
                            ->with('success', 'Venta registrada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                         ->withErrors(['error' => 'Error al registrar la venta: ' . $e->getMessage()]);
        }
    }

    public function detallesVenta($id): View
    {
        $venta = Venta::with([
            'cliente',
            'servicios' => function($query) {
                $query->select('servicio.*', 'detalle_servicio_venta.precio_unitario',
                                            'detalle_servicio_venta.cantidad', 'detalle_servicio_venta.subtotal');
            },
            'accesorios' => function($query) {
                $query->select('accesorios.*', 'detalle_venta_accesorio.precio_unitario',
                                            'detalle_venta_accesorio.cantidad', 'detalle_venta_accesorio.subtotal');
            }
        ])->findOrFail($id);

        return view('catalogos.venta_detalle', [
            'venta' => $venta,
            'breadcrumbs' => [
                'Inicio' => route('home'),
                'Ventas' => route('catalogos.ventas.index'),
                'Detalles de Venta #' . $venta->id => null
            ]
        ]);
    }

    public function editVenta($id): View
    {
        $venta = Venta::with('cliente')->findOrFail($id);

        return view('catalogos.ventas_edit', [
            'venta' => $venta,
            'breadcrumbs' => [
                'Inicio' => route('home'),
                'Ventas' => route('catalogos.ventas.index'),
                'Editar Venta #' . $venta->id => null
            ]
        ]);
    }

    public function updateVenta(Request $request, $id)
    {
        // Validar los datos enviados desde el formulario
        $validated = $request->validate([
            'activo' => 'required|boolean', // Validar 'activo' como booleano
        ]);

        // Buscar la venta y actualizarla
        $venta = Venta::findOrFail($id);
        $venta->update([
            'estado' => $validated['activo'], // Mapear 'activo' a 'estado'
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('catalogos.ventas.index')
                        ->with('success', 'Venta actualizada correctamente');
    }

    public function destroyVenta($id)
    {
        try {
            $venta = Venta::findOrFail($id);
            $venta->delete();

            return redirect()->route('catalogos.ventas.index')
                            ->with('success', 'Venta eliminada correctamente');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar: ' . $e->getMessage()]);
        }
    }

    public function cambiarEstado(Request $request, Venta $venta)
    {
        $request->validate([
            'activo' => 'required|boolean'
        ]);

        $venta->update(['activo' => $request->activo]);

        return back()->with('success', 'Estado de la venta actualizado');
    }

    public function activateVenta($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->update(['activo' => true]);

        return redirect()->route('catalogos.ventas.index')
                        ->with('success', 'Venta activada correctamente');
    }

    public function deactivateVenta($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->update(['activo' => false]);

        return redirect()->route('catalogos.ventas.index')
                        ->with('success', 'Venta desactivada correctamente');
    }
}
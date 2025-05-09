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
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Servicios', 'url' => '']
            ]
        ]);
    }

    public function servicioscreate(): View
    {
        return view('catalogos.servicios_create', [
            "breadcrumbs" => [
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Servicios', 'url' => route('catalogos.servicios')],
                ['title' => 'Crear Servicio', 'url' => '']
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
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Servicios', 'url' => route('catalogos.servicios')],
                ['title' => 'Editar Servicio', 'url' => '']
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
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Accesorios', 'url' => '']
            ]
        ]);
    }

    public function accesorioscreate(): View
    {
        return view('catalogos.accesorios_create', [
            "breadcrumbs" => [
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Accesorios', 'url' => route('catalogos.accesorios')],
                ['title' => 'Crear Accesorio', 'url' => '']
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
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Accesorios', 'url' => route('catalogos.accesorios')],
                ['title' => 'Editar Accesorio', 'url' => '']
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
        ]);
    }

    public function ventascreate(): View
    {
        return view('catalogos.ventas_create', [
            'clientes' => Cliente::all(),
            'servicios' => Servicio::all(),
            'productos' => Accesorio::all(),
            'breadcrumbs' => [
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Ventas', 'url' => route('catalogos.ventas.index')],
                ['title' => 'Nueva Venta', 'url' => '']
            ]
        ]);
    }

    public function ventasCreateExisting(): View
    {
        return view('catalogos.ventas_create_existing', [
            'clientes' => Cliente::all(),
            'servicios' => Servicio::all(),
            'productos' => Accesorio::all(),
            'breadcrumbs' => [
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Ventas', 'url' => route('catalogos.ventas.index')],
                ['title' => 'Nueva Venta (Cliente Existente)', 'url' => '']
            ]
        ]);
    }

    public function storeVenta(Request $request)
    {
        $validated = $request->validate([
            'cliente_opcion' => 'required|in:nuevo,existente',
            'cliente_id' => 'nullable|required_if:cliente_opcion,existente|exists:clientes,id',
            'nombre' => 'nullable|required_if:cliente_opcion,nuevo|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'servicios' => 'nullable|array', // Ahora contendrá arrays con id y cantidad
            'productos' => 'nullable|array', // Ahora contendrá arrays con id y cantidad
            'metodo_pago' => 'nullable|string|max:50'
        ]);

        DB::beginTransaction();
        try {
            if ($validated['cliente_opcion'] === 'nuevo') {
                $cliente = Cliente::create([
                    'nombre' => $validated['nombre'],
                    'direccion' => $validated['direccion'],
                    'telefono' => $validated['telefono']
                ]);
                $clienteId = $cliente->id;
            } else {
                $clienteId = $validated['cliente_id'];
            }

            $venta = Venta::create([
                'fk_id_cliente' => $clienteId,
                'fecha' => $validated['fecha'],
                'total' => $validated['total'],
                'metodo_pago' => $validated['metodo_pago'] ?? null,
                'activo' => true
            ]);

            if (!empty($validated['servicios'])) {
                $serviciosData = [];
                foreach ($validated['servicios'] as $servicioInfo) {
                    if (isset($servicioInfo['id']) && isset($servicioInfo['cantidad'])) {
                        $servicio = Servicio::find($servicioInfo['id']);
                        if ($servicio) {
                            $precioUnitario = $servicio->costo;
                            $cantidad = intval($servicioInfo['cantidad']);
                            $subtotal = $precioUnitario * $cantidad;
                            $serviciosData[$servicioInfo['id']] = [
                                'precio_unitario' => $precioUnitario,
                                'cantidad' => $cantidad,
                                'subtotal' => $subtotal
                            ];
                        }
                    }
                }
                $venta->servicios()->attach($serviciosData);
            }

            if (!empty($validated['productos'])) {
                $productosData = [];
                foreach ($validated['productos'] as $productoInfo) {
                    if (isset($productoInfo['id']) && isset($productoInfo['cantidad'])) {
                        $producto = Accesorio::find($productoInfo['id']);
                        if ($producto) {
                            $precioUnitario = $producto->precio;
                            $cantidad = intval($productoInfo['cantidad']);
                            $subtotal = $precioUnitario * $cantidad;
                            $productosData[$productoInfo['id']] = [
                                'precio_unitario' => $precioUnitario,
                                'cantidad' => $cantidad,
                                'subtotal' => $subtotal
                            ];
                        }
                    }
                }
                $venta->accesorios()->attach($productosData);
            }

            DB::commit();

            return redirect()->route('catalogos.ventas.index')
                            ->with('success', 'Venta registrada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Error al registrar la venta: ' . $e->getMessage()]);
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
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Ventas', 'url' => route('catalogos.ventas.index')],
                ['title' => 'Detalles de Venta #'.$venta->id, 'url' => '']
            ]
        ]);
    }

    public function editVenta($id): View
    {
        $venta = Venta::with('cliente')->findOrFail($id);

        return view('catalogos.ventas_edit', [
            'venta' => $venta,
            'breadcrumbs' => [
                ['title' => 'Inicio', 'url' => route('home')],
                ['title' => 'Ventas', 'url' => route('catalogos.ventas.index')],
                ['title' => 'Editar Venta #'.$venta->id, 'url' => '']
            ]
        ]);
    }
    public function updateVenta(Request $request, $id)
    {
        // Validar los datos enviados desde el formulario
        $validated = $request->validate([
            'activo' => 'required|boolean', // Validar 'activo' como booleano
            'metodo_pago' => 'nullable|string|max:50'
        ]);

        // Buscar la venta y actualizarla
        $venta = Venta::findOrFail($id);
        $venta->update([
            'estado' => $validated['activo'], // Mapear 'activo' a 'estado'
            'metodo_pago' => $validated['metodo_pago']
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
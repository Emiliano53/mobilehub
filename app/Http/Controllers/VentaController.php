<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Servicio;
use App\Models\Accesorio;
use App\Models\Cliente;
use App\Models\Venta;
use Carbon\Carbon;

class VentaController extends Controller
{
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
        \Log::info('Clientes:', Cliente::all()->toArray());
        \Log::info('Servicios:', Servicio::where('estado', 'Activo')->get()->toArray());
        \Log::info('Productos:', Accesorio::where('estado', 1)->get()->toArray());

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
                \Log::info('Cliente creado:', $cliente->toArray());
            } else {
                $clienteId = $validated['cliente_id'];
                \Log::info('Cliente existente seleccionado:', ['cliente_id' => $clienteId]);
            }

            // Crear la venta
            $venta = Venta::create([
                'fk_id_cliente' => $clienteId,
                'fecha' => $validated['fecha'],
                'total' => $validated['total'],
                'activo' => true
            ]);
            \Log::info('Venta creada:', $venta->toArray());

            // Adjuntar servicios
            if (!empty($validated['servicios'])) {
                foreach ($validated['servicios'] as $servicio) {
                    $servicioModel = Servicio::find($servicio['id']);
                    $venta->servicios()->attach($servicio['id'], [
                        'precio_unitario' => $servicioModel->costo,
                        'cantidad' => $servicio['cantidad'],
                        'subtotal' => $servicioModel->costo * $servicio['cantidad']
                    ]);
                    \Log::info('Servicio adjuntado:', [
                        'id' => $servicio['id'],
                        'cantidad' => $servicio['cantidad']
                    ]);
                }
            }

            // Adjuntar productos
            if (!empty($validated['productos'])) {
                foreach ($validated['productos'] as $producto) {
                    $productoModel = Accesorio::find($producto['id']);
                    if ($productoModel && $producto['cantidad'] > 0) {
                        $venta->accesorios()->attach($producto['id'], [
                            'precio_unitario' => $productoModel->precio,
                            'cantidad' => $producto['cantidad'],
                            'subtotal' => $productoModel->precio * $producto['cantidad']
                        ]);

                        // Actualizar existencia
                        $productoModel->decrement('existencia', $producto['cantidad']);
                        \Log::info('Producto procesado y existencia actualizada:', [
                            'id' => $producto['id'],
                            'cantidad' => $producto['cantidad'],
                            'existencia_restante' => $productoModel->existencia
                        ]);
                    } else {
                        \Log::warning('Producto no encontrado o cantidad inválida:', $producto);
                    }
                }
            }

            DB::commit();

            return redirect()->route('catalogos.ventas')
                            ->with('success', 'Venta registrada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al registrar la venta:', ['error' => $e->getMessage()]);
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

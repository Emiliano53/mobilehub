@extends('layouts.app')
@section('title', 'Reporte de Productos')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => [
        'Inicio' => route('home'),
        'Reportes' => route('reportes'),
        'Reporte de Productos' => null,
    ]])
    @endcomponent

<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Reporte de Productos</h1>
        <p class="text-muted">Consulta los productos registrados y su información.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            {{-- <th>Cantidad Vendida</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td>{{ $producto->id_accesorios }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>${{ number_format($producto->precio, 2) }}</td>
                            <td>{{ $producto->existencia }}</td>
                            <td class="text-center">{{ $producto->estado == 1 ? 'Activo' : 'Inactivo' }}</td>
                            {{-- <td>{{ $producto->ventas_count ?? 0 }}</td> --}}
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay productos registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
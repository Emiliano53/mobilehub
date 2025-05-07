<!-- filepath: /opt/lampp/htdocs/mobilehub/resources/views/reportes/reportes.blade.php -->
@extends('layouts.app')
@section('title', 'Reporte de Ventas')

@section('content')
<div class="container py-5">
    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Reporte de Ventas</h1>
        <p class="text-muted">Consulta las ventas realizadas, incluyendo accesorios y servicios.</p>
    </div>

    <!-- Buscador por rango de fechas -->
    <form action="{{ route('reportes.ventas') }}" method="GET" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
            </div>
            <div class="col-md-4">
                <label for="fecha_fin" class="form-label">Fecha Fin</label>
                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-modern btn-modern-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de Ventas -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID Venta</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Accesorios</th>
                            <th>Servicios</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>{{ $venta->cliente->nombre ?? 'Cliente no especificado' }}</td>
                            <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach($venta->accesorios as $accesorio)
                                        <li>{{ $accesorio->nombre }} (x{{ $accesorio->pivot->cantidad }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach($venta->servicios as $servicio)
                                        <li>{{ $servicio->descripcion_servicio }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-end">${{ number_format($venta->total, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No se encontraron ventas en el rango de fechas seleccionado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $ventas->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
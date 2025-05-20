@extends('layouts.app')
@section('title', 'Reporte de Servicios')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => [
        'Inicio' => route('home'),
        'Reportes' => route('reportes'),
        'Reporte de Servicios' => null,
    ]])
    @endcomponent

<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Reporte de Servicios</h1>
        <p class="text-muted">Consulta los servicios registrados y su información.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID Servicio</th>
                            <th>Descripción</th>
                            <th>Costo</th>
                            <th>Estado</th>
                            {{-- Si tienes la cantidad de ventas, descomenta la siguiente línea --}}
                            {{-- <th>Cantidad Vendida</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->id_servicio }}</td>
                            <td>{{ $servicio->descripcion_servicio }}</td>
                            <td>${{ number_format($servicio->costo, 2) }}</td>
                            <td>{{ $servicio->estado }}</td>
                            {{-- <td>{{ $servicio->ventas_count ?? 0 }}</td> --}}
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay servicios registrados.</td>
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
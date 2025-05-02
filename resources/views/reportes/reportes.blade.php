@extends('layouts.app')
@section('title', 'Reportes')

@section('content')
<div class="container py-5">
    <!-- Breadcrumbs -->
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <!-- Título -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Reportes</h1>
        <p class="text-muted">Selecciona el reporte que deseas visualizar</p>
    </div>

    <!-- Opciones de Reportes -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Reporte de Ventas</h5>
                    <p class="card-text text-muted">Consulta los detalles de las ventas realizadas.</p>
                    <a href="{{ url('/reportes/ventas') }}" class="btn btn-modern btn-modern-primary">
                        Ver Reporte de Ventas
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Reporte de Servicios</h5>
                    <p class="card-text text-muted">Consulta los detalles de los servicios realizados.</p>
                    <a href="{{ url('/reportes/servicios') }}" class="btn btn-modern btn-modern-primary">
                        Ver Reporte de Servicios
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Nota y Botón de Volver -->
    <div class="mt-5 text-center">
        <p class="text-muted">Esta página es un extra y no está considerada en el entregable.</p>
        <a href="{{ url()->previous() }}" class="btn btn-modern btn-modern-primary">
            Volver
        </a>
    </div>
</div>
@endsection
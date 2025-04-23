@extends('components.layout')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <h1>Reportes</h1>

    <p>Selecciona el reporte que deseas ver:</p>

    <div>
        <a href="{{ url('/reportes/ventas') }}" class="btn btn-primary">Reporte de Ventas</a>
        <a href="{{ url('/reportes/servicios') }}" class="btn btn-info">Reporte de Servicios</a>
        <a href="{{ url('/reportes/inventario') }}" class="btn btn-success">Reporte de Inventario</a>
    </div>
@endsection
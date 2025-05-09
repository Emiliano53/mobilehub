@extends('layouts.app')
@section('title', 'Servicios')
@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Lista de Servicios</h1>
            <a href="{{ route('catalogos.servicios.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Agregar
            </a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Costo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->descripcion_servicio }}</td>
                        <td>${{ number_format($servicio->costo, 2) }}</td>
                        <td>{{ $servicio->estado }}</td>
                        <td>
                            <a href="{{ route('catalogos.servicios.edit', $servicio->id_servicio) }}" class="btn btn-warning">
                              <i class="fas fa-edit"></i> Editar
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection
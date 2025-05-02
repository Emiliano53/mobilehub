@extends('layouts.app')
@section('title', 'Servicios')
@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
    <div class="container">
        <h1>Lista de Servicios</h1>
        <div class="col-auto titlebar-commands">
            <a class="btn btn-primary" href="{{ route('catalogos.servicios.create') }}">Agregar</a>
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
                            <a href="{{ route('catalogos.servicios.edit', $servicio->id_servicio) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('catalogos.servicios.destroy', $servicio->id_servicio) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este servicio?')">Eliminar</button>
                            </form>
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
@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="container">
    <div class="window">
        <div class="content">
            <h1>LISTA DE VENTAS</h1>
            <div class="button-group mb-3">
                <a href="{{ url('/catalogos/ventas/create') }}" class="btn btn-primary">Venta Nuevo Cliente</a>
                <a href="{{ url('/catalogos/ventas/create-existing') }}" class="btn btn-primary">Venta Cliente Registrado</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->total }}</td>
                        <td>
                            <a href="{{ url('/catalogos/ventas/edit', $venta->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ url('/catalogos/ventas/destroy', $venta->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
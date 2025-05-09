@extends('layouts.app')
@section('title', 'Ventas')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <div class="container">
        <h1 class="mb-4">Ventas</h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('catalogos.ventas') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar cliente..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('catalogos.ventas.create') }}" class="btn btn-primary">Nueva Venta</a>
                <a href="{{ route('catalogos.ventas.create-existing') }}" class="btn btn-secondary ms-2">Cliente Existente</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Fecha</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->cliente->nombre ?? 'Cliente no especificado' }}</td>
                                <td>{{ $venta->fecha->format('d/m/Y') }}</td>
                                <td class="text-end">${{ number_format($venta->total, 2) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('catalogos.ventas.detalles', $venta->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Detalles
                                    </a>
                                    <a href="{{ route('catalogos.ventas.edit', $venta->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $ventas->links() }}
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
@endsection

@extends('components.layout')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <h1 class="text-center">Registrar Venta - Cliente Existente</h1>

    <form action="{{ route('catalogos.ventas.store') }}" method="POST" class="mt-4">
        @csrf

        <!-- Selección de cliente existente -->
        <div class="form-group">
            <label for="cliente_id">Seleccionar Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} - {{ $cliente->telefono }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selección de servicios -->
        <div class="form-group mt-4">
            <label for="servicios">Servicios</label>
            <select name="servicios[]" id="servicios" class="form-control" multiple>
                @foreach ($servicios as $servicio)
                    <option value="{{ $servicio->id_servicio }}">{{ $servicio->descripcion_servicio }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selección de productos -->
        <div class="form-group">
            <label for="productos">Productos</label>
            <select name="productos[]" id="productos" class="form-control" multiple>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_accesorios }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success btn-block">Registrar Venta</button>
    </form>
@endsection
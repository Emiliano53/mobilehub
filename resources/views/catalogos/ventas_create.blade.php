@extends('layouts.app')
@section('title', 'Registrar Venta')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <h1 class="text-center">Registrar Venta</h1>

    <form action="{{ route('catalogos.ventas.store') }}" method="POST" class="mt-4">
        @csrf

        <!-- Formulario para nuevo cliente -->
        <div id="form-nuevo-cliente" class="mt-3">
            <h4>Registrar Nuevo Cliente</h4>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del cliente" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección del cliente" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono del cliente" required>
            </div>
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
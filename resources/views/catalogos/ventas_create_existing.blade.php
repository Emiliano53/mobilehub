@extends('layouts.app')

@section('title', 'Registrar Venta - Cliente Existente')
@section('content')

@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

@endcomponent
<h1 class="text-center">Registrar Venta - Cliente Existente</h1>

<form action="{{ route('catalogos.ventas.store') }}" method="POST" class="mt-4">
    @csrf

    <div class="form-group">
        <label for="cliente_id">Seleccionar Cliente</label>
        <select name="cliente_id" id="cliente_id" class="form-control" required>
            <option value="">Seleccione un cliente</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }} - {{ $cliente->telefono }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4">
        <label>Servicios</label>
        <div id="servicios-container">
        </div>
        <button type="button" id="agregar-servicio" class="btn btn-secondary btn-sm mt-2">Agregar Servicio</button>
    </div>

    <div class="mt-4">
        <label>Accesorios</label>
        <div id="accesorios-container">
        </div>
        <button type="button" id="agregar-accesorio" class="btn btn-secondary btn-sm mt-2">Agregar Accesorio</button>
    </div>

    <button type="submit" class="btn btn-success btn-block mt-4">Registrar Venta</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviciosContainer = document.getElementById('servicios-container');
        const agregarServicioBtn = document.getElementById('agregar-servicio');
        let contadorServicios = 0;

        agregarServicioBtn.addEventListener('click', function () {
            contadorServicios++;
            const nuevoServicioDiv = document.createElement('div');
            nuevoServicioDiv.classList.add('form-row', 'mb-2', 'align-items-center');
            nuevoServicioDiv.innerHTML = `
                <div class="col-md-6">
                    <label for="servicio_${contadorServicios}">Servicio</label>
                    <select name="servicios[${contadorServicios}][id]" id="servicio_${contadorServicios}" class="form-control" required>
                        <option value="">Seleccione un servicio</option>
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id_servicio }}">{{ $servicio->descripcion_servicio }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad_servicio_${contadorServicios}">Cantidad</label>
                    <input type="number" name="servicios[${contadorServicios}][cantidad]" id="cantidad_servicio_${contadorServicios}" class="form-control" value="1" min="1" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger btn-sm eliminar-servicio">Eliminar</button>
                </div>
            `;
            serviciosContainer.appendChild(nuevoServicioDiv);

            const botonesEliminar = serviciosContainer.querySelectorAll('.eliminar-servicio');
            botonesEliminar.forEach(boton => {
                boton.addEventListener('click', function (event) {
                    event.target.closest('.form-row').remove();
                });
            });
        });

        const accesoriosContainer = document.getElementById('accesorios-container');
        const agregarAccesorioBtn = document.getElementById('agregar-accesorio');
        let contadorAccesorios = 0;

        agregarAccesorioBtn.addEventListener('click', function () {
            contadorAccesorios++;
            const nuevoAccesorioDiv = document.createElement('div');
            nuevoAccesorioDiv.classList.add('form-row', 'mb-2', 'align-items-center');
            nuevoAccesorioDiv.innerHTML = `
                <div class="col-md-6">
                    <label for="producto_${contadorAccesorios}">Producto</label>
                    <select name="productos[${contadorAccesorios}][id]" id="producto_${contadorAccesorios}" class="form-control" required>
                        <option value="">Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id_accesorios }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cantidad_producto_${contadorAccesorios}">Cantidad</label>
                    <input type="number" name="productos[${contadorAccesorios}][cantidad]" id="cantidad_producto_${contadorAccesorios}" class="form-control" value="1" min="1" required>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-danger btn-sm eliminar-accesorio">Eliminar</button>
                </div>
            `;
            accesoriosContainer.appendChild(nuevoAccesorioDiv);

            const botonesEliminar = accesoriosContainer.querySelectorAll('.eliminar-accesorio');
            botonesEliminar.forEach(boton => {
                boton.addEventListener('click', function (event) {
                    event.target.closest('.form-row').remove();
                });
            });
        });
    });
</script>
@endsection
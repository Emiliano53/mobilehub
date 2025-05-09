@extends('layouts.app')

@section('title', 'Registrar Venta - Cliente Existente')
@section('content')

@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="text-center mb-4">Registrar Venta - Cliente Existente</h1>

    <form action="{{ route('catalogos.ventas.store') }}" method="POST" id="venta-form">
        @csrf
        <input type="hidden" name="cliente_opcion" value="existente">
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Selección de Cliente</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="cliente_id">Cliente *</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id_cliente }}">
                                {{ $cliente->nombre }} - {{ $cliente->telefono }} - {{ $cliente->direccion }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- El resto del formulario es igual al de nueva venta -->
        @include('catalogos.partials.venta_detalles_form')

        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg">
                <i class="fas fa-save"></i> Registrar Venta
            </button>
            <a href="{{ route('catalogos.ventas') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<!-- Mismo JavaScript que en ventas_create.blade.php -->
@endsection
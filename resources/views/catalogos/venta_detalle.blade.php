@extends('layouts.app')
@section('title', 'Detalles de Venta')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Detalles de Venta #{{ $venta->id }}</h2>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h4><strong>Información del Cliente</strong></h4>
                    <hr>
                    <p class="mb-1"><strong>Nombre:</strong> {{ $venta->cliente->nombre ?? 'No especificado' }}</p>
                    <p class="mb-1"><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'No especificado' }}</p>
                    <p class="mb-0"><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y') }}</p>
                </div>
                
                <div class="col-md-6">
                    <h4><strong>Información de Pago</strong></h4>
                    <hr>
                    <p class="mb-1"><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
                </div>
            </div>
            
            <div class="mb-4">
                <h4><strong>Descripción de la Venta</strong></h4>
                <hr>
                <p class="mb-0">{{ $venta->descripcion ?? 'Venta de productos y servicios' }}</p>
            </div>
            
            <div class="mb-4">
                <h4><strong>Items Vendidos</strong></h4>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th class="text-end">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->servicios as $servicio)
                            <tr>
                                <td>Servicio</td>
                                <td>{{ $servicio->descripcion_servicio }}</td>
                                <td class="text-end">${{ number_format($servicio->pivot->precio_unitario, 2) }}</td>
                            </tr>
                            @endforeach
                            
                            @foreach($venta->accesorios as $accesorio)
                            <tr>
                                <td>Accesorio</td>
                                <td>{{ $accesorio->nombre }}</td>
                                <td class="text-end">${{ number_format($accesorio->pivot->precio_unitario, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end">Total:</th>
                                <th class="text-end">${{ number_format($venta->total, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            <div class="text-end mt-4">
                <a href="{{ route('catalogos.ventas.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
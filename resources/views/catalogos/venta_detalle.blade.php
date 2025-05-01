@extends('components.layout')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h4 mb-0">Detalles de Venta #{{ $venta->id }}</h2>
        </div>
        
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h3 class="h5 mb-0">Información del Cliente</h3>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Nombre:</strong> {{ $venta->cliente->nombre ?? 'No especificado' }}</p>
                            <p class="mb-0"><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'No especificado' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h3 class="h5 mb-0">Información de Pago</h3>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
                            <p class="mb-2"><strong>Método de pago:</strong> {{ $venta->metodo_pago ?? 'No especificado' }}</p>
                            <p class="mb-0"><strong>Estado:</strong> 
                                @if($venta->activo)
                                    <span class="badge bg-success">Activo</span>
                                @else
                                    <span class="badge bg-secondary">Inactivo</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <h3 class="h5">Descripción de la Venta</h3>
                <hr class="my-2">
                <p class="mb-0">{{ $venta->descripcion ?? 'Venta de productos y servicios' }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="h5">Items Vendidos</h3>
                <hr class="my-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
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
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('catalogos.ventas.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver al Listado
                </a>
                <div>
                    
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
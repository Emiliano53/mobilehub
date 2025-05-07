@extends('layouts.app')
@section('title', 'Editar Venta')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Editar Venta #{{ $venta->id }}</h4>
                <span class="badge bg-{{ $venta->activo ? 'success' : 'secondary' }}">
                    {{ $venta->activo ? 'Activo' : 'Inactivo' }}
                </span>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Mensajes de validación -->
            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4">
                <h5 class="fw-semibold">Información de la Venta</h5>
                <hr class="mt-2 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <p class="mb-2"><strong>Cliente:</strong> {{ $venta->cliente->nombre ?? 'No especificado' }}</p>
                        <p class="mb-0"><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('catalogos.ventas.update', $venta->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="activo" class="form-label fw-semibold">Estado de la Venta</label>
                    <select name="activo" id="activo" class="form-select" required>
                        <option value="1" {{ $venta->activo ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ !$venta->activo ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    <small class="text-muted">Las ventas inactivas no aparecerán en algunos reportes</small>
                </div>

                <div class="d-flex justify-content-between pt-3 border-top">
                    <a href="{{ route('catalogos.ventas.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Volver al listado
                    </a>
                    <div>
                        <button type="reset" class="btn btn-outline-danger me-2">
                            <i class="fas fa-undo me-2"></i> Restablecer
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Guardar cambios
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación básica del formulario
        const form = document.querySelector('form');
        
        form.addEventListener('submit', function(e) {
            const metodoPago = document.getElementById('metodo_pago').value;
            
            if(metodoPago.trim() === '') {
                if(!confirm('¿Está seguro de dejar el método de pago vacío?')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endsection
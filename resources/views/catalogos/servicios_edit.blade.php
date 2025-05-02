@extends('layouts.app')
@section('title', 'Editar Servicio')
@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Editar Servicio</h1>
        </div>
        
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('catalogos.servicios.update', $servicio->id_servicio) }}" method="POST" id="serviceForm">
                @csrf
                @method('PUT')
                
                <!-- Campo Descripción -->
                <div class="mb-3">
                    <label for="descripcion_servicio" class="form-label">Descripción:</label>
                    <input type="text" class="form-control @error('descripcion_servicio') is-invalid @enderror" 
                           id="descripcion_servicio" name="descripcion_servicio" 
                           value="{{ old('descripcion_servicio', $servicio->descripcion_servicio) }}" required>
                    @error('descripcion_servicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Campo Precio -->
                <div class="mb-3">
                    <label for="costo" class="form-label">Precio (MXN):</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" min="0" 
                               class="form-control @error('costo') is-invalid @enderror" 
                               id="costo" name="costo" 
                               value="{{ old('costo', $servicio->costo) }}" required>
                        @error('costo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Campo Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select class="form-select @error('estado') is-invalid @enderror" 
                            id="estado" name="estado" required>
                        <option value="Activo" {{ old('estado', $servicio->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $servicio->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Botones -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <i class="fas fa-save me-1"></i> Actualizar
                    </button>
                    <a href="{{ route('catalogos.servicios') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Validación adicional del formulario
    document.getElementById('serviceForm').addEventListener('submit', function(e) {
        const precio = document.getElementById('costo').value;
        if(precio <= 0) {
            e.preventDefault();
            alert('El precio debe ser mayor que cero');
            return false;
        }
        return true;
    });
</script>
@endsection
@endsection
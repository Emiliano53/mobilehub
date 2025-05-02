@extends('layouts.app')
@section('title', 'Editar Accesorio')
@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="container">
    <h1>Editar Accesorio</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('catalogos.accesorios.update', $accesorio->id_accesorios) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                       id="nombre" name="nombre" value="{{ old('nombre', $accesorio->nombre) }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="tipo" class="form-label">Tipo:</label>
                <select class="form-select @error('tipo') is-invalid @enderror" id="tipo" name="tipo" required>
                    <option value="Protección" {{ old('tipo', $accesorio->tipo) == 'Protección' ? 'selected' : '' }}>Protección</option>
                    <option value="Cargador" {{ old('tipo', $accesorio->tipo) == 'Cargador' ? 'selected' : '' }}>Cargador</option>
                    <option value="Audio" {{ old('tipo', $accesorio->tipo) == 'Audio' ? 'selected' : '' }}>Audio</option>
                    <option value="Otro" {{ old('tipo', $accesorio->tipo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('tipo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="marca" class="form-label">Marca:</label>
                <input type="text" class="form-control @error('marca') is-invalid @enderror" 
                       id="marca" name="marca" value="{{ old('marca', $accesorio->marca) }}" required>
                @error('marca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="precio" class="form-label">Precio (MXN):</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="0.01" min="0" 
                           class="form-control @error('precio') is-invalid @enderror" 
                           id="precio" name="precio" value="{{ old('precio', $accesorio->precio) }}" required>
                </div>
                @error('precio')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="existencia" class="form-label">Existencia:</label>
                <input type="number" min="0" class="form-control @error('existencia') is-invalid @enderror" 
                       id="existencia" name="existencia" value="{{ old('existencia', $accesorio->existencia) }}" required>
                @error('existencia')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                    <option value="Activo" {{ old('estado', $accesorio->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado', $accesorio->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Actualizar
            </button>
            <a href="{{ route('catalogos.accesorios') }}" class="btn btn-secondary ms-2">
                <i class="fas fa-times me-1"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
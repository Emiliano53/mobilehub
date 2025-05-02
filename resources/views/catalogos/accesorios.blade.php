@extends('layouts.app')
@section('title', 'Lista de Accesorios')
@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Accesorios</h1>
        <a href="{{ route('catalogos.accesorios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Agregar
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0">Nombre</th>
                            <th class="border-0">Tipo</th>
                            <th class="border-0">Marca</th>
                            <th class="border-0 text-end">Precio</th>
                            <th class="border-0 text-center">Existencia</th>
                            <th class="border-0 text-center">Estado</th>
                            <th class="border-0 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($accesorios as $accesorio)
                        <tr>
                            <td class="align-middle">{{ $accesorio->nombre }}</td>
                            <td class="align-middle">{{ $accesorio->tipo }}</td>
                            <td class="align-middle">{{ $accesorio->marca }}</td>
                            <td class="align-middle text-end">${{ number_format($accesorio->precio, 2) }}</td>
                            <td class="align-middle text-center">{{ $accesorio->existencia }}</td>
                            <td class="align-middle text-center">
                                {{ $accesorio->estado == 1 ? 'Activo' : 'Inactivo' }}
                            </td>
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('catalogos.accesorios.edit', $accesorio->id_accesorios) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('catalogos.accesorios.destroy', $accesorio->id_accesorios) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Estás seguro de eliminar este accesorio?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No hay accesorios registrados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($accesorios->hasPages())
    <div class="d-flex justify-content-center mt-4">
        <nav aria-label="Paginación de accesorios">
            {{ $accesorios->onEachSide(1)->links('pagination::bootstrap-5') }}
        </nav>
    </div>
    @endif
    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
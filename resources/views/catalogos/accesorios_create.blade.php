@extends('layouts.app')
@section('title', 'Registrar Accesorio')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent
<div class="container">
    <div class="window">
        <div class="content">
            <h1>REGISTRAR ACCESORIO</h1>

            <form action="{{ route('catalogos.accesorios.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="buscar_accesorio">Buscar Accesorio</label>
                    <input type="text" id="buscar_accesorio" class="form-control" placeholder="Buscar por nombre o tipo">
                    <small class="text-muted">Si el accesorio ya existe, se actualizará su existencia.</small>
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control" required>
                        <option value="">Seleccione un tipo</option>
                        <option value="Protección">Protección</option>
                        <option value="Cargador">Cargador</option>
                        <option value="Audio">Audio</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="existencia">Existencia</label>
                    <input type="number" name="existencia" id="existencia" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control" required>
                </div>
                <p></p>
                
                <div class="form-group">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('buscar_accesorio').addEventListener('input', function() {
    const query = this.value;

    fetch(`/api/accesorios/buscar?query=${query}`)
        .then(response => response.json())
        .then(data => {
            // Mostrar resultados de búsqueda
            console.log(data);
        });
});
</script>
@endsection
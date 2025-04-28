@extends('components.layout') 

@section('content')
<div class="container">
    <div class="window">
        <div class="title-bar">
            MobileHub | Accesorios | Registro
        </div>
        <div class="content">
            <h1>REGISTRAR ACCESORIO</h1>

            <form action="{{ route('catalogos.accesorios.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" name="tipo" id="tipo" class="form-control" required>
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

                <div class="form-group">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
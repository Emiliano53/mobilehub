@extends('layouts.app')

@section('content')
<div class="container">
    <div class="window">
        <div class="title-bar">
            MobileHub | Servicio | Registro
        </div>
        <div class="content">
            <h1>REGISTRAR SERVICIO</h1>

            <form action="{{ url('/catalogos/servicios/store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control">
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control">
                </div>

                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" class="form-control">
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
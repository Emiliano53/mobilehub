@extends('components.layout')

@section('content')
<div class="container">
    <div class="window">
        <div class="title-bar">
            MobileHub | Servicios | Editar
        </div>
        <div class="content">
            <h1>EDITAR SERVICIO</h1>

            <form action="{{ url('catalogos/servicios/update', $servicio->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="descripcion_servicio">Descripción</label>
                    <input type="text" name="descripcion_servicio" id="descripcion_servicio" class="form-control" value="{{ $servicio->descripcion_servicio }}" required>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" id="estado" class="form-control" value="{{ $servicio->estado }}" required>
                </div>

                <div class="form-group">
                    <label for="costo">Precio</label>
                    <input type="number" name="costo" id="costo" class="form-control" value="{{ $servicio->costo }}" required>
                </div>

                <div class="button-group">
                    <button type="button" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
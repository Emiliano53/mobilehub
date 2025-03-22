@extends('components.layout')

@section('content')
<div class="container">
    <div class="window">
        <div class="title-bar">
            MobileHub | Ventas | Registro
        </div>
        <div class="content">
            <h1>REGISTRAR VENTA</h1>

            <form action="{{ url('ventas/store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" name="total" id="total" class="form-control" required>
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
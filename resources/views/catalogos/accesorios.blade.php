@extends('components.layout')

@section('content')
<div class="container">
    <div class="window">
        <div class="title-bar">
            MobileHub | Accesorios
        </div>
        <div class="content">
            <h1>LISTA DE ACCESORIOS</h1>
            <div class="button-group mb-3">
                <a href="{{ url('/catalogos/accesorios/create') }}" class="btn btn-primary">Crear Accesorio</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accesorios as $accesorio)
                    <tr>
                        <td>{{ $accesorio->id_accesorios }}</td>
                        <td>{{ $accesorio->nombre }}</td>
                        <td>{{ $accesorio->tipo }}</td>
                        <td>{{ $accesorio->marca }}</td>
                        <td>{{ $accesorio->precio }}</td>
                        <td>{{ $accesorio->existencia }}</td>
                        <td>
                            <a href="{{ url('/catalogos/accesorios/' . $accesorio->id_accesorios . '/edit') }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ url('/catalogos/accesorios/' . $accesorio->id_accesorios) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
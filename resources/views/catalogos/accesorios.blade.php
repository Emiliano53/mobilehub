@extends("components.layout")
@section('content')
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
    <div class="container">
        <h1>Lista de Accesorios</h1>
        <div class="col-auto titlebar-commands">
            <a class="btn btn-primary" href="{{url('/catalogos/accesorios/create')}}">Agregar</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Existencia</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accesorios as $accesorio)
                    <tr>
                        <td>{{ $accesorio->nombre }}</td>
                        <td>{{ $accesorio->tipo }}</td>
                        <td>${{ number_format($accesorio->precio, 2) }}</td>
                        <td>{{ $accesorio->existencia }}</td>
                        <td>{{ $accesorio->marca }}</td>
                        <td>
                            <a href="{{ url('/catalogos/accesorios.edit', $accesorio->id_accesorios) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ url('/catalogos/accesorios.destroy', $accesorio->id_accesorios) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

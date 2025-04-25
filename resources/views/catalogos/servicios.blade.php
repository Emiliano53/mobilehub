@extends("components.layout")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
@section('content')
    <div class="container">
        <h1>Lista de Servicios</h1>
        <div class="col-auto titlebar-commands">
            <a class="btn btn-primary" href="{{ url('/catalogos/servicios/create') }}">Agregar</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Costo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->descripcion_servicio }}</td>
                        <td>${{ number_format($servicio->costo, 2) }}</td>
                        <td>{{ $servicio->estado }}</td>
                        <td>
                            <a href="{{ url('/catalogos/servicios/' . $servicio->id_servicio . '/edit') }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ url('/catalogos/servicios/' . $servicio->id_servicio) }}" method="POST" style="display:inline;">
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
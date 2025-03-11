@extends("components.layout")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
@section('content')
    <div class="container">
        <h1>Lista de Ventas</h1>
        <div class="col-auto titlebar-commands">
            <a class="btn btn-primary" href="{{url('/catalogos/ventas/create')}}">Agregar</a>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td>{{ $venta->descripcion }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                        <td>
                            <a href="{{ url('/catalogos/ventas.edit', $venta->id_venta) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ url('/catalogos/ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline;">
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

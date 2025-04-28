@extends('components.layout')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <h1>Reporte de Ventas</h1>

    @if ($ventas->isEmpty())
        <p>No hay ventas registradas.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha Venta</th>
                    <th>Total</th>
                    {{-- Agrega más columnas según la estructura de tu tabla 'venta' --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->total }}</td>
                        {{-- Muestra más datos de la venta si los tienes --}}
                        <td>
                            @if ($venta->accesorios)
                                <ul>
                                    @foreach ($venta->accesorios as $accesorio)
                                        <li>{{ $accesorio->nombre }} (ID: {{ $accesorio->id_accesorios }})</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                }
            });
        });
    </script>
@endsection
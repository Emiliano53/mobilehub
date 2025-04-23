@extends('components.layout')

@section('content')
    @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <h1>Reporte de Servicios</h1>

    @if ($servicios->isEmpty())
        <p>No hay servicios registrados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Servicio</th>
                    <th>Nombre Servicio</th>
                    <th>Descripción</th>
                    {{-- Agrega más columnas según la estructura de tu tabla 'servicios' --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->id_servicio }}</td>
                        <td>{{ $servicio->nombre }}</td>
                        <td>{{ $servicio->descripcion }}</td>
                        {{-- Muestra más datos del servicio --}}
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
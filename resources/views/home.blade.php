@extends("components.layout")
@section("content")
<div class="container mt-4">
    @component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
    @endcomponent

    <div class="card-header">
                    <h2>Bienvenido a MobileHub</h2>
                </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Catálogos</h5>
                    <p class="card-text">Gestiona tus servicios y accesorios</p>
                    <a href="{{ route('catalogos.servicios') }}" class="btn btn-light">Servicios</a>
                    <a href="{{ route('catalogos.accesorios') }}" class="btn btn-light">Accesorios</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Ventas</h5>
                    <p class="card-text">Administra tus ventas</p>
                    <a href="{{ route('catalogos.ventas.index') }}" class="btn btn-light">Ver Ventas</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Genera reportes detallados</p>
                    <a href="{{ route('reportes') }}" class="btn btn-light">Ver Reportes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('components.layout')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="welcome-card">
            <div class="card-body p-4 p-md-5">
                <h1 class="welcome-title display-4 fw-bold mb-3">Bienvenido a MobileHub</h1>
                <p class="lead mb-0 text-muted">
                    Sistema integral de gestión para servicios móviles y accesorios
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Catálogos -->
    <div class="col-md-6 col-lg-4">
        <div class="feature-card">
            <div class="card-header-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-box-open"></i>
                    <h3 class="mb-0">Catálogos</h3>
                </div>
            </div>
            <div class="card-body p-4">
                <p class="card-text text-muted mb-4">Gestiona tus servicios y accesorios</p>
                <div class="d-grid gap-2 d-md-flex">
                    <a href="{{ route('catalogos.servicios') }}" class="btn btn-modern btn-modern-primary me-md-2">
                        <i class="fas fa-tools me-2"></i> Servicios
                    </a>
                    <a href="{{ route('catalogos.accesorios') }}" class="btn btn-modern btn-modern-primary">
                        <i class="fas fa-mobile-alt me-2"></i> Accesorios
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ventas -->
    <div class="col-md-6 col-lg-4">
        <div class="feature-card">
            <div class="card-header-custom" style="background: linear-gradient(135deg, var(--success), #00a884);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-cash-register"></i>
                    <h3 class="mb-0">Ventas</h3>
                </div>
            </div>
            <div class="card-body p-4">
                <p class="card-text text-muted mb-4">Administra tus ventas</p>
                <a href="{{ route('catalogos.ventas.index') }}" class="btn btn-modern btn-modern-primary" style="background: var(--success);">
                    <i class="fas fa-list me-2"></i> Ver Ventas
                </a>
            </div>
        </div>
    </div>

    <!-- Reportes -->
    <div class="col-md-6 col-lg-4">
        <div class="feature-card">
            <div class="card-header-custom" style="background: linear-gradient(135deg, var(--info), #0878d4);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-chart-pie"></i>
                    <h3 class="mb-0">Reportes</h3>
                </div>
            </div>
            <div class="card-body p-4">
                <p class="card-text text-muted mb-4">Genera reportes detallados</p>
                <a href="{{ route('reportes') }}" class="btn btn-modern btn-modern-primary" style="background: var(--info);">
                    <i class="fas fa-chart-line me-2"></i> Ver Reportes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
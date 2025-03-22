<nav class="sidebar nav flex-column pt-5">
    <div class="sidebar-logo">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo de la Aplicación">
    </div>

    <a href="{{ url('/catalogos/servicios') }}" class="nav-link">Servicios</a>
    <a href="{{ url('/catalogos/accesorios') }}" class="nav-link">Accesorios</a>
    <a href="{{ url('/catalogos/ventas') }}" class="nav-link">Ventas</a>
    <a href="{{ url('/reportes/') }}" class="nav-link">Reportes</a>
    <a href="{{ url('/logout') }}" class="nav-link">Salir</a>
</nav>
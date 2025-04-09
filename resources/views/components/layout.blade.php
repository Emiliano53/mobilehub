<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href={{ URL::asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }} />
    <script src={{ URL::asset('bootstrap-5.3.3-dist/js/bootstrap.min.js') }}></script>
    <link href={{ URL::asset('DataTables/datatables.css') }} rel="stylesheet"/>
    <script src={{ URL::asset('DataTables/datatables.js') }}></script>
    <link href={{ URL::asset('assets/style.css') }} rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Hub</title>
</head>
<body style="height: 100vh; margin: 0;">
    <div class="row" style="height: 100vh;">
        <div class="col-12">
            <div class="header-menu-container">
                <div class="logo-container">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Mobile Hub" style="max-height: 150px;">
                </div>
                <div class="menu-bar">
                    <a href="{{ url('/catalogos/servicios') }}" class="nav-link">Servicios</a>
                    <a href="{{ url('/catalogos/accesorios') }}">Accesorios</a>
                    <a href="{{ url('/catalogos/ventas') }}">Ventas</a>
                    <a href="{{ url('/reportes/') }}">Reportes</a>
                    <a href="{{ url('/logout') }}">Salir</a>
                </div>
            </div>
            <div class="container">
                @section("content")
                @show
            </div>
        </div>
    </div>
</body>
</html>
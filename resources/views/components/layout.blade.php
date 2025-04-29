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
    <style>
        .header-wrapper {
            display: flex;
            align-items: flex-start; /* Alinea los elementos en la parte superior */
        }

        .logo-container-left {
            background-color: #f8f9fa; /* Un fondo claro para la solapa */
            padding: 10px;
            margin-right: 10px; /* Espacio entre el logo y la barra */
            border-bottom-right-radius: 5px; /* Curva inferior derecha */
        }

        .header-menu-container {
            background-color: #007bff; /* El color azul de tu barra */
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
        }

        .menu-bar a {
            color: white !important;
            margin-right: 15px;
            text-decoration: none;
        }

        .menu-bar a:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body style="height: 100vh; margin: 0; display: flex; flex-direction: column;">
    <div class="header-wrapper">
        <div class="logo-container-left">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Mobile Hub" style="max-height: 60px;">
        </div>
        <div class="header-menu-container">
            <div class="menu-bar">
                <a href="{{ url('/catalogos/servicios') }}" class="nav-link">Servicios</a>
                <a href="{{ url('/catalogos/accesorios') }}">Accesorios</a>
                <a href="{{ url('/catalogos/ventas') }}">Ventas</a>
                <a href="{{ url('/reportes/') }}">Reportes</a>
                <a href="{{ url('/logout') }}">Salir</a>
            </div>
        </div>
    </div>
    <div class="row flex-grow-1" style="margin: 0;">
        <div class="col-12">
            <div class="container mt-4">
                @section("content")
                @show
            </div>
        </div>
    </div>
</body>
</html>
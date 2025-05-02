<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobileHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6c5ce7;
            --secondary: #5649d6;
            --accent: #fd79a8;
            --light: #f8f9fa;
            --dark: #2d3436;
            --success: #00b894;
            --info: #0984e3;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9ff;
            min-height: 100vh;
        }
        
        /* Navbar Estilizado */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 0.5rem 1rem;
        }
        
        .logo-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .logo-rounded {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
            transition: all 0.3s ease;
        }
        
        .logo-rounded:hover {
            transform: rotate(15deg);
            box-shadow: 0 6px 20px rgba(108, 92, 231, 0.4);
        }
        
        .brand-name {
            font-weight: 700;
            color: var(--dark);
            margin-left: 12px;
            font-size: 1.4rem;
        }
        
        .nav-item-custom .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            margin: 0 0.25rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .nav-item-custom .nav-link:hover, 
        .nav-item-custom .nav-link.active {
            background: var(--primary);
            color: white !important;
            transform: translateY(-2px);
        }
        
        /* Contenido Principal */
        .main-container {
            padding-top: 2.5rem;
            padding-bottom: 3rem;
        }
        
        /* Tarjeta de Bienvenida */
        .welcome-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(108, 92, 231, 0.1);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
            border-left: 6px solid var(--primary);
        }
        
        .welcome-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(108, 92, 231, 0.15);
        }
        
        .welcome-title {
            color: var(--primary);
            font-weight: 700;
            position: relative;
            display: inline-block;
        }
        
        .welcome-title:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        /* Tarjetas de Características */
        .feature-card {
            border-radius: 18px;
            overflow: hidden;
            border: none;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            background: white;
            position: relative;
        }
        
        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .card-header-custom:after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(30deg);
        }
        
        .card-header-custom i {
            font-size: 1.8rem;
            margin-right: 15px;
            color: white;
        }
        
        /* Botones Modernos */
        .btn-modern {
            border-radius: 50px;
            padding: 0.7rem 1.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.5px;
        }
        
        .btn-modern-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-modern-primary:hover {
            background: var(--secondary);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 92, 231, 0.3);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="logo-brand" href="#">
                <img src="{{ asset('images/logo.jpeg') }}" alt="MobileHub" class="logo-rounded">
                <span class="brand-name d-none d-md-inline">MobileHub</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item nav-item-custom">
                        <a class="nav-link" href="{{ url('/catalogos/servicios') }}">
                            <i class="fas fa-tools me-2"></i> Servicios
                        </a>
                    </li>
                    <li class="nav-item nav-item-custom">
                        <a class="nav-link" href="{{ url('/catalogos/accesorios') }}">
                            <i class="fas fa-mobile-alt me-2"></i> Accesorios
                        </a>
                    </li>
                    <li class="nav-item nav-item-custom">
                        <a class="nav-link" href="{{ url('/catalogos/ventas') }}">
                            <i class="fas fa-shopping-cart me-2"></i> Ventas
                        </a>
                    </li>
                    <li class="nav-item nav-item-custom">
                        <a class="nav-link" href="{{ url('/reportes') }}">
                            <i class="fas fa-chart-bar me-2"></i> Reportes
                        </a>
                    </li>
                    <li class="nav-item nav-item-custom ms-lg-2">
                        <a class="nav-link text-danger" href="{{ url('/logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i> Salir
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container main-container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.getAttribute('href') === currentUrl) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
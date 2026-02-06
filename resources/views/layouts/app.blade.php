<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">    
    @yield('estilos')
    <link rel="shortcut icon" href="{{ asset('img/eds.png') }}" type="image/x-icon">
    @yield('scripts-head')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}"><i class="bi bi-bus-front me-2"></i>EDS Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}"><i
                                class="bi bi-house me-1"></i>Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('corridas') }}"><i
                                class="bi bi-bus-front-fill me-1"></i>Corridas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('buscar.corridas') }}"><i
                                class="bi bi-cart me-1"></i>Ventas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('viajes') }}"><i
                                class="bi bi-luggage me-1"></i>Viajes</a></li>                   
                    <li class="nav-item"><a class="nav-link" href="{{ route('usuarios') }}"><i
                                class="bi bi-people me-1"></i>Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="reportes.html"><i
                                class="bi bi-graph-up me-1"></i>Reportes</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>Usuario
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <form action="{{ route('logout') }} " method="POST">
                                @csrf
                                <li><button type="submit" class="dropdown-item" href="index.html">Salir</button></li>
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('contenido')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>

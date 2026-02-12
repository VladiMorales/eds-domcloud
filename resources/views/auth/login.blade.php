<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EDS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="shortcut icon" href="img/eds.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="d-flex align-items-center justify-content-center p-3">
    <div class="card login-card w-100" style="max-width: 400px;">
        <div class="card-header text-center py-4">
            <h2 class="mb-0"><i class="bi bi-bus-front me-2"></i>EDS</h2>
            <p class="mb-0 opacity-75">ENLACES DEL SUR</p>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="username" class="form-control" placeholder="Ingresa tu usuario">
                </div>
                <div class="mb-4">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña">
                </div>
                 {{-- @if (session('mensaje'))
                    <p>{{session('mensaje')}}</p>
                 @endif --}}
                                
                <button type="submit" class="btn btn-login w-100 text-white py-2 fw-bold">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
     @if (session('mensaje') == 'incorrecto')
        <script>
            Swal.fire({
                title: "Credenciales Incorrectas",
                icon: "error",
                draggable: true
            });
        </script>    
    @endif
</body>

</html>
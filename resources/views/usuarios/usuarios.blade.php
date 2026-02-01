@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Usuarios - EDS
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('scripts-head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('contenido')

    {{-- Tabla y contenido --}}
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-people me-2"></i>Gestión de Usuarios</h3>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#userModal">
                <i class="bi bi-plus-circle me-2"></i>Agregar Usuario
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>                                
                                <th>Rol</th>
                                <th>Nombre de Usuario</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->tipo == "admin" ? "Administrador" : "Vendedor" }}</td>
                                    <td>{{ $usuario->username }}</td>
                                    <td><span class="badge bg-success">Activo</span></td>
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal"
                                            data-bs-target="#userEditModal" onclick="llenarInputs({{ $usuario }})">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('usuarios.delete', ['id' => $usuario->id]) }}" method="POST" id="form-eliminar{{ $usuario->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="eliminarU({{ $usuario->id }})" type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Agregar Usuario --}}
    <div class="modal fade" id="userModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Crear Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('usuarios') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control">
                        </div>                        
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Repite la Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select name="tipo" class="form-select">
                                <option value="">--Selecciona un Tipo--</option>
                                <option value="admin">Administrador</option>
                                <option value="venta">Vendedor</option>
                            </select>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Editar Usuario --}}
    <div class="modal fade" id="userEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" id="formEdit">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" id="nameEdit" name="name" class="form-control">
                        </div>                        
                        <div class="mb-3">
                            <label class="form-label">Usuario</label>
                            <input type="text" id="usernameEdit" name="username" class="form-control">
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Repite la Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div> --}}
                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select id="tipoEdit" name="tipo" class="form-select">
                                <option value="">--Selecciona un Tipo--</option>
                                <option value="admin">Administrador</option>
                                <option value="venta">Vendedor</option>
                            </select>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <a  class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    
@endsection

@section('scripts')
    <script src="{{ asset('js/alertasUsuario.js')}}"></script>
    @if (session('mensaje') == 'creado')
        <script>
            usuarioCreado();
        </script>
    @elseif (session('mensaje') == 'editado')
        <script>
            usuarioEditado();
        </script>
    @elseif (session('mensaje') == 'eliminado')
        <script>
            usuarioEliminado();
        </script>
    @endif
@endsection
    
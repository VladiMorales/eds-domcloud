@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Agencias - EDS
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/dash.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('scripts-head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    {{-- Tabla y contenido de la página --}}
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-bus-front-fill me-2"></i>Gestión de Agencias</h3>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#agenciaModal">
                <i class="bi bi-plus-circle me-2"></i>Agregar Agencia
            </button>
        </div>        
        <br>        
        <div class="card mx-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Status</th>
                                <th>Acciones</th>                                                      
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($agencias as $agencia)                            
                                <tr>
                                    <td>{{ $agencia->id }}</td>
                                    <td>{{ $agencia->nombre }}</td>
                                    <td><span class="badge {{ $agencia->status == 'activo' ? 'bg-success' : 'bg-danger' }}">{{ $agencia->status }}</span></td>
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="llenarInputs({{ $agencia }})" data-bs-toggle="modal"
                                            data-bs-target="#agenciaEditModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('agencias.delete', ['id' => $agencia->id]) }}" method="POST" id="form-eliminar{{ $agencia->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="eliminarA({{ $agencia->id }})" type="submit" class="btn btn-sm btn-outline-danger me-1">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $agencias->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Agregar Agencia --}}
    <div class="modal fade" id="agenciaModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Crear Agencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agencias') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
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

    {{-- Modal Editar Agencia --}}
    <div class="modal fade" id="agenciaEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Editar Agencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('agencias') }}" id="formEdit">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" id="nombreEdit" name="nombre" class="form-control" required>
                        </div>                                                                                                              
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                    <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/alertasAgencias.js')}}"></script>
    @if (session('mensaje') == 'creado')
    <script>
        agenciaCreada();
    </script>
    @elseif (session('mensaje') == 'editado')
        <script>
            agenciaEditada();
        </script>
    @elseif (session('mensaje') == 'eliminado')
        <script>
            agenciaEliminada();
        </script>
    @endif
@endsection
    
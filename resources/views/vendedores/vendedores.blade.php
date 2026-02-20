@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Vendedores - EDS
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
            <h3><i class="bi bi-bus-front-fill me-2"></i>Gestión de Vendedores</h3>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#vendedorModal">
                <i class="bi bi-plus-circle me-2"></i>Agregar Vendedor
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
                                <th>Acciones</th>                                                      
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($vendedores as $vendedor)                            
                                <tr>
                                    <td>{{ $vendedor->id }}</td>
                                    <td>{{ $vendedor->nombre }}</td>                                                                                                         
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="llenarInputs({{ $vendedor }})" data-bs-toggle="modal"
                                            data-bs-target="#vendedorEditModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('vendedores.delete', ['id' => $vendedor->id]) }}" method="POST" id="form-eliminar{{ $vendedor->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="eliminarV({{ $vendedor->id }})" type="submit" class="btn btn-sm btn-outline-danger me-1">
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

    {{-- Modal Agregar Agencia --}}
    <div class="modal fade" id="vendedorModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Crear Vendedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vendedores') }}">
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
    <div class="modal fade" id="vendedorEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Editar Vendedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('vendedores') }}" id="formEdit">
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
    <script src="{{ asset('js/alertasVendedores.js')}}"></script>
    @if (session('mensaje') == 'creado')
        <script>
            vendedorCreado();
        </script>
    @elseif (session('mensaje') == 'editado')
        <script>
            vendedorEditado();
        </script>
    @elseif (session('mensaje') == 'eliminado')
        <script>
            vendedorEliminado();
        </script>
    @endif
@endsection
    
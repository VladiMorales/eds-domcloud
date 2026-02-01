@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Corridas - EDS
@endsection

@section('estilos')    
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('scripts-head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('contenido')

    {{-- Tabla y contenido de la página --}}
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-bus-front-fill me-2"></i>Gestión de Corridas</h3>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#corridaModal">
                <i class="bi bi-plus-circle me-2"></i>Agregar Corrida
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Destino</th>                           
                                <th>Fecha</th>
                                <th>Horario</th>                               
                                <th>Boletos Disponibles</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($corridas as $corrida)
                                <tr>
                                    <td>{{ $corrida->id }}</td>
                                    <td>{{ $corrida->destino }}</td>
                                    <td>{{ $corrida->fecha }}</td>
                                    <td>{{ $corrida->horario }}</td>                                                                    
                                    <td>{{ $corrida->boletos_disponibles }}</td>                                    
                                    {{-- <td><span class="badge bg-success">Activo</span></td> --}}
                                    <td class="d-flex">
                                        <button class="btn btn-sm btn-outline-primary me-1" onclick="llenarInputs({{ $corrida }})" data-bs-toggle="modal"
                                            data-bs-target="#corridaEditModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('corridas.delete', ['id' => $corrida->id]) }}" method="POST" id="form-eliminar{{ $corrida->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="eliminarC({{ $corrida->id }})" type="submit" class="btn btn-sm btn-outline-danger">
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

    {{-- Modal Agregar corrida --}}
    <div class="modal fade" id="corridaModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Crear Corrida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('corridas') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Fecha de Salida</label>
                            <input type="date" name="fecha" class="form-control" required>
                        </div>                        
                        <div class="mb-3">
                            <label class="form-label">Horario de Salida</label>
                            <input type="time" name="horario" class="form-control" required>
                        </div>                        
                        {{-- <div class="mb-3">
                            <label class="form-label">Boletos Disponibles</label>
                            <input type="number" name="boletos_disponibles" value="14" class="form-control" required>
                        </div>   --}}                      
                    
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Editar Corrida --}}
    <div class="modal fade" id="corridaEditModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: var(--eds-gold); color: #000;">
                    <h5 class="modal-title">Editar Corrida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('corridas') }}" id="formEdit">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Fecha de Salida</label>
                            <input type="date" id="fechaEdit" name="fecha" class="form-control" required>
                        </div>                        
                        <div class="mb-3">
                            <label class="form-label">Horario de Salida</label>
                            <input type="time" id="horarioEdit" name="horario" class="form-control" required>
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Precio del Boleto</label>
                            <input type="number" id="precioEdit" name="precio_boleto" class="form-control" required>
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label class="form-label">Boletos Disponibles</label>
                            <input type="number" name="boletos_disponibles" value="14" class="form-control" required>
                        </div>   --}}                      
                    
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
    <script src="{{ asset('js/alertasCorridas.js')}}"></script>
    @if (session('mensaje') == 'creado')
        <script>
            corridaCreada();
        </script>
    @elseif (session('mensaje') == 'editado')
        <script>
            corridaEditada();
        </script>
    @elseif (session('mensaje') == 'eliminado')
        <script>
            corridaEliminada();
        </script>
    @endif
@endsection
    
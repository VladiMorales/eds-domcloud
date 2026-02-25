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
        @role('admin')
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="bi bi-bus-front-fill me-2"></i>Gestión de Corridas</h3>
                <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#corridaModal">
                    <i class="bi bi-plus-circle me-2"></i>Agregar Corrida
                </button>
            </div>
        @endrole
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-filter me-2"></i>Filtrar Corridas Por Fecha</h5>                
            </div>
            <div class="card-body">
                <form class="row g-3" method="POST" action="{{ route('corridas.filtrar') }}">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label">Fecha Inicial</label>
                        <input type="date" name="fecha_inicio"  value="{{old('fecha_inicio', request('fecha_inicio'))}}" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha Final</label>
                        <input type="date" name="fecha_fin" value="{{old('fecha_fin', request('fecha_fin'))}}" class="form-control" required>
                    </div>
                                                            
                    <div class="col-12">
                        <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Aplicar
                            Filtros</button>
                    </div>
                </form>
            </div>
        </div>
        <br>        
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
                                <th>Boletos Vendidos</th>
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
                                    <td>{{ $corrida->boletos_vendidos }}</td>                                    
                                    <td class="d-flex">
                                        @role('admin')
                                            <button class="btn btn-sm btn-outline-primary me-1" onclick="llenarInputs({{ $corrida }})" data-bs-toggle="modal"
                                                data-bs-target="#corridaEditModal">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('corridas.delete', ['id' => $corrida->id]) }}" method="POST" id="form-eliminar{{ $corrida->id }}">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="eliminarC({{ $corrida->id }})" type="submit" class="btn btn-sm btn-outline-danger me-1">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endrole
                                        <a href="{{ route('corridas.pasajeros', ['id' => $corrida->id]) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-list-task"></i>
                                        </a>
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
    @role('admin')
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
    @endrole

    {{-- Modal Editar Corrida --}}
    @role('admin')        
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
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
                        <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endrole
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
    
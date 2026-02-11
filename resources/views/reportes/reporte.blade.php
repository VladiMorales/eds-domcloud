@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Reportes - EDS
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/dash.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/reporte.css') }}">
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    <div class="container-fluid mt-4">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-box text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="text-primary mb-1">{{ $boletos }}</h2>
                        <p class="mb-0">Boletos Vendidos</p>
                    </div>
                </div>
            </div>            
            <div class="col-md-3">
                <div class="card stat-box text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="text-success mb-1">${{ $ingresos }}</h2>
                        <p class="mb-0">Ingresos Total</p>
                    </div>
                </div>
            </div>            
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-filter me-2"></i>Filtros Reportes</h5>
                <div>
                    <a href="{{ route('reportes.pdf', request()->query()) }}" class="btn" style="background: var(--eds-gold); color: #000;">Generar PDF</a>
                    <a href="{{ route('reportes.excel', request()->query()) }}" class="btn" style="background: var(--eds-gold); color: #000;">Generar XLSX</a>
                </div>
            </div>
            <div class="card-body">
                <form class="row g-3" method="POST" action="{{ route('reportes') }}">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label">Fecha Inicial</label>
                        <input type="date" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha Final</label>
                        <input type="date" name="fecha_fin" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select" required>
                            <option value="todas">Todas</option>
                            <option value="boletos">Boletos</option>
                            <option value="viajes">Viajes</option>                            
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Usuario</label>
                        <select name="usuario" class="form-select" required>
                            <option value="todos">Todos</option>
                            @foreach ($usuarios as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach                                                        
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Agencias</label required>
                        <select name="agencia" class="form-select">
                            <option value="todas">Todas</option>
                            @foreach ($agencias as $agencia)
                                <option value="{{ $agencia->id }}">{{ $agencia->nombre }}</option>
                            @endforeach                                                        
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Aplicar
                            Filtros</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">Historial Filtrado</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>                                                             
                                <th>Boletos Vendidos</th>
                                <th>Monto</th>
                                <th>Método de Pago</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Agencia</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($ventas as $venta)                            
                                <tr>                                    
                                    <td>#{{ $venta->id }}</td>
                                    <td>{{ $venta->boletos_vendidos>0 ? $venta->boletos_vendidos : 'Viaje' }}</td>
                                    <td>${{ $venta->total }}</td>
                                    <td>{{ $venta->metodo_pago }}</td>
                                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $venta->user->name }}</td>
                                    <td>{{ $venta->agencia->nombre }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
@endsection
    
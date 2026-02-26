@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Reportes - EDS
@endsection

@section('estilos')    
    <link rel="stylesheet" href="{{ asset('css/reporte.css') }}">
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    <div class="container-fluid mt-4">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stat-box text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="text-primary mb-1">{{ $boletosVendidos }}</h2>
                        <p class="mb-0">Boletos Vendidos</p>
                    </div>
                </div>
            </div>            
            <div class="col-md-3">
                <div class="card stat-box text-center border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="text-success mb-1">${{ $total }}</h2>
                        <p class="mb-0">Total Ventas</p>
                    </div>
                </div>
            </div>            
        </div>

        <div class="card">
            {{-- <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="bi bi-filter me-2"></i>Filtros Reportes</h5>
                <div>
                    <a href="{{ route('reportes.pdf', request()->query()) }}" class="btn" style="background: var(--eds-gold); color: #000;">Generar PDF</a>
                    <a href="{{ route('reportes.excel', request()->query()) }}" class="btn" style="background: var(--eds-gold); color: #000;">Generar XLSX</a>
                </div>
            </div> --}}
            {{-- <div class="card-body">
                <form class="row g-3" method="POST" action="{{ route('reportes.vendedor') }}">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label">Fecha Inicial</label>
                        <input type="date" value="{{old('fecha_inicio', request('fecha_inicio'))}}" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Fecha Final</label>
                        <input type="date" value="{{old('fecha_fin', request('fecha_fin'))}}" name="fecha_fin" class="form-control" required>
                    </div>                    
                    <div class="col-12">
                        <button type="submit" class="btn" style="background: var(--eds-red); color: white;">Aplicar
                            Filtros</button>
                    </div>
                </form>
            </div> --}}
        </div>

        <div class="card mt-4">
            <div class="card-header">Historial Filtrado</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>                                                             
                                <th>Pasajero</th>
                                <th>Precio</th>
                                <th>Método de Pago</th>
                                <th>Fecha</th>
                                <th>Corrida Horario</th>
                                <th>Agencia</th>                                                             
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($boletos as $boleto)  
                                <tr>                                    
                                    <td>#{{ $boleto->id }}</td>
                                    <td>{{ $boleto->pasajero_nombre }}</td>
                                    <td>${{ $boleto->precio }}</td>
                                    <td>{{ $boleto->venta->metodo_pago }}</td>
                                    <td>{{ \Carbon\Carbon::parse($boleto->venta->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ $boleto->corrida->horario }}</td>
                                    <td>{{ $boleto->venta->agencia->nombre }}</td>                                    
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
@endsection
    
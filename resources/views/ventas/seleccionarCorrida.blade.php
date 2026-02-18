@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Ventas - EDS
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    <link rel="stylesheet" href="{{ asset('css/vender.css') }}">
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3><i class="bi bi-bus-front-fill me-2"></i>Corridas para {{ $fecha }}</h3>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Horario</th>                                                                
                                <th>Boletos Vendidos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($corridas as $corrida)
                                <tr>
                                    <td>{{ $corrida->id }}</td>
                                    <td>{{ $corrida->horario }}</td>                                                                    
                                    <td>{{ $corrida->boletos_vendidos }}</td>                                                                                                          
                                    <td class="d-flex">
                                        <a href="{{ route('pasajeros.nombres', ['id'=>$corrida->id, 'numBoletos' => $numBoletos]) }}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-cart2">Comprar</i>
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
@endsection
    
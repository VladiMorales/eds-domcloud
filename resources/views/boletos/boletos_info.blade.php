@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Cambios Venta
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reporte.css') }}">
@endsection

@section('scripts-head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    <div class="container-fluid mt-4">
        
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Información de la Venta</h5>            
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>                                                             
                                <th>Boletos Vendidos</th>
                                <th>Total</th>
                                <th>Método de Pago</th>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Agencia</th>
                            </tr>
                        </thead>
                        <tbody>                                                   
                            <tr>                                    
                                <td>#{{ $venta->id }}</td>
                                <td>{{ $venta->boletos_vendidos>0 ? $venta->boletos_vendidos : 'Viaje' }}</td>
                                <td>${{ $venta->total }}</td>
                                <td>{{ $venta->metodo_pago }}</td>
                                <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $venta->user->name }}</td>
                                <td>{{ $venta->agencia->nombre }}</td>
                            </tr>                                                        
                        </tbody>
                    </table>
                    <div class="d-flex">
                        <form class="me-2" method="POST" id="form-cancelar" action="{{ route('cancelar.venta', ['idV' => $venta->id, 'idC' => $corrida]) }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" onclick="cancelarV()"  class="btn mb-2" style="background: var(--eds-gold); color: #000;">Cancelar Venta y Boletos</button>                        
                        </form>
                        
                            <a href="{{ route('escoger.corrida', ['id' => $venta->id]) }}" class="btn mb-2" style="background: var(--eds-gold); color: #000;">Cambiar Corrida</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">Boletos en la venta: {{$venta->boletos_vendidos}}</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>                                                             
                                <th>Pasajero</th>
                                <th>Tipo</th>
                                <th>Zona de Abordaje</th>
                                <th>Fecha</th>
                                <th>Horario</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($boletos as $boleto)                            
                                <tr>                                    
                                    <td>#{{ $boleto->id }}</td>
                                    <td>{{ $boleto->pasajero_nombre }}</td>
                                    <td>{{ $boleto->tipo }}</td>
                                    <td>{{ $boleto->zona->direccion }}</td>
                                    <td>{{ \Carbon\Carbon::parse($boleto->corrida->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($boleto->corrida->horario)->format('H:i');  }}</td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>   
@endsection

@section('scripts')
    <script src="{{ asset('js/alertasBoletos.js')}}"></script>
@endsection
@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Pasajeros - EDS
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    <link rel="stylesheet" href="{{ asset('css/vender.css') }}">
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-cart-plus me-2"></i>Vender Boleto</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('realizar.venta') }}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-xs-4 mb-3 d-none">
                                    <label class="form-label ">Corrida:</label>
                                    <input type="text" name="corrida" value="{{ $id }}" class="form-control" required readonly>
                                </div>
                                <div class="col-xs-4 mb-3 d-none">
                                    <label class="form-label">Boletos:</label>
                                    <input type="text" name="boletos" value="{{ $numBoletos }}" class="form-control" required readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Precio Boleto</label>
                                    <input value="250" type="text" name="precio" class="form-control" required>
                                </div>
                                @for ($i=0; $i<$numBoletos; $i++)
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nombre Pasajero {{ ($i+1) }}</label>
                                        <input type="text" name="pasajero{{($i+1)}}" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Tipo Pasajero {{ ($i+1) }}</label>
                                        <select class="form-control" name="tipo{{$i+1}}"  required>
                                            <option value="adulto">Adulto</option>
                                            <option value="niño">Niño</option>                                            
                                        </select>                                        
                                    </div>                                    
                                @endfor
                                                                                          
                                <div class="col-12 mb-3">
                                    <label class="form-label">Método Pago</label>
                                    <select name="metodoPago" class="form-select" required>
                                        <option value="">--Selecciona Método Pago--</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Tarjeta">Tarjeta</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label class="form-label">Zona de abordaje</label>
                                    <select name="zona" class="form-select" required>
                                        <option value="">--Selecciona Zona--</option>
                                        @foreach ($zonas as $zona)
                                            <option value="{{ $zona->id }}">{{ $zona->direccion }}</option>
                                        @endforeach
                                                                                
                                    </select>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Agencia</label>
                                    <select name="agencia" class="form-select" required>
                                        <option value="">--Selecciona Agencia--</option>
                                        @foreach ($agencias as $agencia)
                                            <option value="{{ $agencia->id }}">{{ $agencia->nombre }}</option>
                                        @endforeach
                                                                                
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-confirm w-100">
                                <i class="bi bi-check-circle me-2"></i>Realizar la Venta
                            </button>
                        </form>
                        <button type="submit" class="mt-2 btn btn-confirm w-100">
                            <i class="bi bi-x-circle me-2"></i>Cancelar Venta
                        </button>
                    </div>
                </div>
            </div>            
        </div>
    </div>
@endsection
    
@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Viajes - EDS
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
                        <h5><i class="bi bi-cart-plus me-2"></i>Datos del Viaje</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('viajes') }}" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-xs-4 mb-3">
                                    <label class="form-label ">Fecha del Viaje:</label>
                                    <input type="date" name="fecha" class="form-control" required>
                                </div>
                                <div class="col-xs-4 mb-3">
                                    <label class="form-label">Horario del Viaje:</label>
                                    <input type="time" name="horario" class="form-control" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Tipo</label>
                                    <select name="tipo" class="form-select" required>
                                        <option value="">--Selecciona Tipo Viaje--</option>
                                        <option value="parcial">Parcial</option>
                                        <option value="completo">Completo</option>
                                        
                                    </select>
                                </div>
                                <div class="col-xs-4 mb-3">
                                    <label class="form-label">Destino</label>
                                    <input type="text" name="destino" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Precio Viaje</label>
                                    <input type="number" name="precio" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Nombre del Cliente</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>                               
                                                                                          
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
                                <i class="bi bi-check-circle me-2"></i>Realizar Venta Viaje
                            </button>
                        </form>
                        <a href="{{ route('dashboard') }}" class="mt-2 btn btn-confirm w-100">
                            <i class="bi bi-x-circle me-2"></i>Cancelar Viaje
                        </a>
                    </div>
                </div>
            </div>            
        </div>
    </div>
@endsection
    
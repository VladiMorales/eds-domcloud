@extends('layouts.app')

@section('titulo')    
    Vender - EDS
@endsection

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/vender.css') }}">
@endsection

@section('contenido')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-cart-plus me-2"></i>Vender Boleto</h5>
                    </div>
                    <div class="card-body">
                        <form id="boletoForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre Pasajero</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Destino</label>
                                    <select class="form-select" required>
                                        <option>Tuxtla Gutiérrez</option>
                                        <option>CDMX</option>
                                        <option>Guadalajara</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Fecha</label>
                                    <input type="date" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Hora</label>
                                    <input type="time" class="form-control" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Precio</label>
                                    <input type="number" class="form-control" value="450" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Método Pago</label>
                                    <select class="form-select" required>
                                        <option>Efectivo</option>
                                        <option>Tarjeta</option>
                                        <option>Transferencia</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-confirm w-100">
                                <i class="bi bi-check-circle me-2"></i>Generar Boleto
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card ticket-preview h-100">
                    <div class="card-header text-center bg-warning text-dark">
                        <h6>PREVIEW BOLETO</h6>
                    </div>
                    <div class="card-body text-center p-4">
                        <div id="previewContent">
                            <h4 class="mb-3">BOLETO EDS #001</h4>
                            <p class="fs-5 mb-1"><strong>Juan Pérez</strong></p>
                            <p class="mb-4">→ Tuxtla Gutiérrez<br>10 Ene 2026 - 14:00</p>
                            <div class="border-top pt-3">
                                <p class="mb-1">$450 MXN</p>
                                <span class="badge bg-success fs-6">VENDIDO</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('boletoForm').addEventListener('input', function () {
            // Actualizar preview en tiempo real (simplificado)
            document.querySelector('#previewContent h4').textContent = 'BOLETO EDS #GEN';
        });
    </script>
@endsection
    
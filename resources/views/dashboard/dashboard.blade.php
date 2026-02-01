@extends('layouts.app')

@section('titulo')
    Dashboard - EDS
@endsection

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
@endsection

@section('contenido')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card stat-card h-100 text-center">
                    <div class="card-header">
                        <h5>Boletos Vendidos</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-success">127</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stat-card h-100 text-center">
                    <div class="card-header">
                        <h5>Reservas Pendientes</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-warning">34</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stat-card h-100 text-center">
                    <div class="card-header">
                        <h5>Ingresos Hoy</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-primary">$12,450</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card stat-card h-100 text-center">
                    <div class="card-header">
                        <h5>Usuarios Activos</h5>
                    </div>
                    <div class="card-body">
                        <h2 class="text-info">8</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Últimos Boletos</h5>
                        <a href="vender.html" class="btn btn-sm" style="background: var(--eds-gold); color: #000;">+
                            Nuevo</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Destino</th>
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#001</td>
                                        <td>Tuxtla Gutiérrez</td>
                                        <td>2026-01-10</td>
                                        <td>Juan Pérez</td>
                                        <td><span class="badge bg-success">Vendido</span></td>
                                    </tr>
                                    <tr>
                                        <td>#002</td>
                                        <td>CDMX</td>
                                        <td>2026-01-11</td>
                                        <td>María López</td>
                                        <td><span class="badge bg-warning">Reservado</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    
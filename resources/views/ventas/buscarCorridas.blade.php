@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Filtar Fechas - EDS
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    <section class="d-flex align-items-center justify-content-center p-3">
        <div class="card login-card w-100" style="max-width: 400px;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('buscar.corridas') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Fecha de Salida</label>
                        <input type="date" name="fecha" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Numero de boletos</label>
                        <input type="number" name="numero_boletos" class="form-control">
                    </div>
                                    
                    <button type="submit" class="btn btn-login w-100 text-white py-2 fw-bold">
                        <i class="bi bi-search me-2"></i>Buscar
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
    
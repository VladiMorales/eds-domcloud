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

@section('scripts-head')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('contenido')
    {{-- Aqui va el contenido --}}
    <section class="d-flex align-items-center justify-content-center p-3">
        <div class="card login-card w-100" style="max-width: 400px;">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('buscar.corrida.cambio') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Fecha de Salida</label>
                        <input type="date" name="fecha" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">ID Venta</label>
                        <input type="number" value="{{ $venta->id }}" name="id_venta" class="form-control" readonly>
                    </div>
                                    
                    <button type="submit" class="btn btn-login w-100 text-white py-2 fw-bold">
                        <i class="bi bi-search me-2"></i>Buscar
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')    
    @if (session('mensaje') == 'error')
        <script>
            Swal.fire({
                title: "Boletos no disponibles",
                icon: "error",
                draggable: true
            });
        </script>
    @endif
@endsection
    
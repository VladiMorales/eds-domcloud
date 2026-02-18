@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Dashboard - EDS
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
                <form method="POST" action="{{ route('boletos.gestion') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Introduce el ID de un boleto</label>
                        <input type="number" name="id" class="form-control">
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
    <script src="{{ asset('js/alertasBoletos.js')}}"></script>
    @if (session('mensaje') == 'invalido')
        <script>
            corridaRealizada()
        </script>    
    @endif
    @if (session('mensaje') == 'noexiste')
        <script>
            boletoNoEncontrado()
        </script>    
    @endif
    @if (session('mensaje') == 'eliminado')
        <script>
            boletoEliminado()
        </script>    
    @endif
    
@endsection
    
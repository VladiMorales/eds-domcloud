@extends('layouts.app')

@section('titulo')
    {{-- titulo de la pagina --}}
    Descarga Boletos - EDS
@endsection

@section('estilos')
    {{-- estilos de la pagina --}}
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('contenido')
    <div class="card login-card w-100" style="max-width: 400px;">
        <div class="card-body p-4">
            <div style="margin-top: 20px;">
                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} ">
            </div>
            <a href="{{ $url }}">Descargar Boletos</a>
        </div>
    </div>
@endsection
    
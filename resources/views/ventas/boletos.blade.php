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
    <div class="min-vh-100 d-flex align-items-center justify-content-center p-3">
  <div class="card border-0 shadow-sm w-100" style="max-width: 460px; border-radius: 18px;">
    <div class="card-header border-0 text-white"
         style="background: linear-gradient(135deg,#dc3545,#fdba74); border-radius: 18px 18px 0 0;">
      <div class="d-flex align-items-center justify-content-between">
        <div class="fw-semibold">Descarga tus Boletos</div>
        <span class="badge text-bg-light">EDS</span>
      </div>
      <div class="small opacity-75">ENLACES DEL SUR</div>
    </div>

    <div class="card-body text-center p-4">
      @if(!empty($url))
        <div class="mx-auto bg-light p-3 rounded-4" style="width: fit-content;">
          <img
            class="img-fluid"
            style="max-width: 260px;"
            alt="Código QR para descargar boletos"
            src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(260)->margin(1)->generate($url)) !!}"
          >
        </div>

        <p class="text-muted mt-3 mb-3">Escanea el QR o descarga con el botón.</p>

        <div class="d-grid gap-2">
          <a class="btn text-white"
             style="background: linear-gradient(135deg,#dc3545,#fdba74); border: 0;"
             href="{{ $url }}"
             target="_blank">
            Descargar boletos
          </a>
          <a class="btn btn-outline-secondary" href="{{ route('buscar.corridas') }}">
            Volver
          </a>
        </div>
      @else
        <div class="py-4">          
          <div class="text-muted mt-3">Ocurrio un error</div>
        </div>
      @endif
    </div>

    <div class="card-footer bg-white border-0 text-center small text-muted pb-4">
      © {{ date('Y') }} EDS
    </div>
  </div>
</div>
@endsection
    
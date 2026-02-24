<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boletos de Venta</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #f8f9fa; /* Fondo gris claro general */
            padding: 20px;
        }

        /* --- Estilos de tu Diseño (Card) --- */
        .ticket-card {
            width: 100%;
            max-width: 600px; /* Ancho máximo para que no se vea gigante */
            margin: 0 auto;   /* Centrado */
            background-color: #fff;
            border: 1px solid #ddd;
            /* Box-shadow no siempre renderiza bien en PDF, mejor usar bordes */
        }

        .header-yellow {
            background-color: #ffc107; /* El amarillo de tu imagen */
            color: #000;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
            border-bottom: 1px solid #e0a800;
        }

        .card-body {
            padding: 5px;
            text-align: center;
        }

        h2 { margin: 10px 0; color: #333; font-size: 22px; }
        h3 { margin: 5px 0 20px 0; font-size: 18px; color: #333; }
        
        .route-info {
            color: #555;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }

        .badge-vendido {
            background-color: #198754; /* Verde similar a tu imagen */
            color: #fff;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
            text-transform: uppercase;
        }

        /* --- LA CLAVE DEL ÉXITO: SALTO DE PÁGINA --- */
        .page-break {
            page-break-after: always;
        }
        
        .img-logo{
            width: 45%;
        }

        .boleto-titulo{
            font-size: 10px;
            color: #555;
        }

        .nombre-psj{
            font-size: 25px !important;
        }

        .boleto-no{
            font-size: 15px !important;
        }
    </style>
</head>
<body>

    @foreach($boletos as $boleto)
        
        <div class="ticket-card">
            <div class="header-yellow">
                Boleto Electronico
            </div>
            
            <div class="card-body">
                {{-- <img src="{{ public_path('img/enlaces_logo.jpeg') }}" class="img-logo" alt=""> --}}
                <br>
                <img src="{{ public_path('img/transport.png') }}" class="img-logo" alt="">
                <h5 class="boleto-titulo">SAN CRISTOBAL DE LAS CASAS, CHIAPAS</h5>
                <h2 class="boleto-no">BOLETO No. #{{ $boleto['id'] }}</h2>                
                
                <h3 class="nombre-psj">{{ $boleto['nombre_pasajero'] }}</h3>
                
                
                <div class="route-info">
                    <!-- {{-- &rarr;  --}} -->{{-- {{ $boleto['destino'] }} --}}
                    EDS Transport<br>
                    {{ $boleto['fecha'] }}<br>
                    {{ $boleto['horario'] }}<br>
                    Abordaje: {{ $boleto['zona'] }}
                </div>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                <div class="price">
                    ${{ number_format($boleto['precio'], 2) }} MXN<br>
                    Tipo: {{ $boleto['tipo'] }}<br>
                    Metodo de pago: {{ $boleto['metodo_pago'] }}<br>
                    
                </div>

                <div class="badge-vendido">
                    VENDIDO
                </div>
                <div class="route-info">
                    <p>ATENCIÓN A CLIENTES: 967 166 5525</p>
                    <p>
                        Valido únicamente para la fecha y hora marcadas en el boleto<br>
                        Incluido el seguro del viajero
                    </p>
                    <p>Ventas y Facturación: ventas.enlacesds@outlook.es<br>
                        Este boleto es canjeable por factura
                    </p>
                </div>
                <!-- {{-- <div style="margin-top: 20px;">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($boleto['folio'])) !!} ">
                </div> --}} -->
                <div style="margin-top: 20px;">
                    
                </div>
            </div>
        </div>

        @if(!$loop->last)
            <div class="page-break"></div>
        @endif

    @endforeach

</body>
</html>
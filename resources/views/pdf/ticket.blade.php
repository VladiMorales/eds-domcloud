<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletos de Venta</title>
    <style>
        /* Estilos Base para Compatibilidad con PDF */
        body {
            background-color: #e9ecef;
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Botón de descarga (Solo visible en navegador) */
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-download {
            background-color: #dc3545;
            color: white;
            padding: 10px 30px;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Contenedor Principal del Boleto */
        .ticket-page {
            background: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 0 auto;
        }

        /* Tarjeta de Datos (Amarilla) */
        .data-card {
            background-color: #fcf6d6;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            overflow: hidden; /* Limpia floats */
        }

        /* Sistema de Columnas Manual (Compatible con dompdf) */
        .row {
            width: 100%;
            display: table; /* Usamos tabla para asegurar alineación en PDF antiguos */
            table-layout: fixed;
        }

        .col {
            display: table-cell;
            vertical-align: top;
        }

        .border-divider {
            border-right: 1px solid rgba(255, 193, 7, 0.3);
            padding-right: 20px;
        }

        .ps-4 {
            padding-left: 25px;
        }

        /* Tipografía de Datos */
        .label-text {
            color: #444;
            font-size: 13px;
            font-weight: bold;
            display: block;
            margin-bottom: 2px;
        }

        .data-text {
            color: #b22222;
            font-weight: bold;
            font-size: 19px;
            display: block;
            margin-bottom: 12px;
        }

        .data-text-small {
            font-size: 17px;
        }

        /* Imágenes y Recursos */
        .qr-box {
            width: 110px;
            height: 110px;
            background: white;
            border: 1px solid #ddd;
            padding: 5px;
            margin-top: 10px;
        }

        .qr-box img {
            width: 100%;
            height: 100%;
        }

        .eds-brand {
            text-align: right;
            margin-top: 10px;
        }

        .eds-brand img {
            height: 35px;
            width: auto;
        }

        .banner-container {
            width: 100%;
            margin-bottom: 20px;
        }

        .banner-img {
            width: 100%;
            border-radius: 10px;
            display: block;
        }

        /* Políticas */
        .policy-container {
            font-size: 10px;
            line-height: 1.3;
            color: #444;
            text-align: justify;
            border-top: 1px dotted #ccc;
            padding-top: 15px;
        }

        .policy-title {
            color: #b22222;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
            text-align: left;
        }

        .page-break {
            page-break-after: always;
        }

        /* Utilidad para Ocultar en Impresión */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white;
                padding: 0;
            }
            .ticket-page {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

    @foreach($boletos as $boleto)
        
        <div class="container">
        <!-- Sección de control (No se procesa en el PDF final) -->        
        <!-- Área del Boleto -->
        <div id="vista-boleto" class="ticket-page">

            <div class="data-card">
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col border-divider">
                        <span class="label-text">Nombre:</span>
                        <span class="data-text">{{ $boleto['nombre_pasajero'] }}</span>

                        <span class="label-text">Origen/abordaje:</span>
                        <span class="data-text">{{ $boleto['zona'] }}</span>

                        <span class="label-text">Servicio:</span>
                        <span class="data-text">Compartido</span>

                        <div class="qr-box">
                            <img src="{{ public_path('img/boleto/qr.png') }}" alt="QR del Boleto">
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="col ps-4">
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col">
                                <span class="label-text">Fecha:</span>
                                <span class="data-text data-text-small">{{ $boleto['fecha'] }}</span>
                            </div>
                            <div class="col">
                                <span class="label-text">Hora:</span>
                                <span class="data-text data-text-small">{{ $boleto['horario'] }}</span>
                            </div>
                        </div>

                        <span class="label-text">No. Folio:</span>
                        <span class="data-text">{{ $boleto['id'] }}</span>

                        <span class="label-text">Precio total:</span>
                        <span class="data-text">${{ number_format($boleto['precio'], 2) }} MXN</span>

                        <span class="label-text">Pago:</span>
                        <span class="data-text">{{ $boleto['metodo_pago'] }}</span>

                        <div class="eds-brand">
                            <img src="{{ public_path('img/boleto/eds.png') }}" alt="Logo EDS">
                        </div>
                    </div>
                </div>
            </div>

            <div class="banner-container">
                <img src="{{ public_path('img/boleto/horizontal_info.png') }}" alt="Banner Informativo" class="banner-img">
            </div>

            <div class="policy-container">
                <div class="policy-title">Condiciones de Uso y Políticas - EDS Transport</div>
                <p>
                    Para cualquier aclaración, duda o solicitud relacionada con su viaje, ponemos a su disposición nuestro servicio de atención a clientes al número 967 166 5525, donde con gusto podremos brindarle asistencia. Asimismo, puede obtener información adicional escaneando el código QR que se encuentra impreso en este boleto.
                    Este boleto es válido únicamente para la fecha, hora y servicio especificados en el mismo, por lo que le recomendamos verificar cuidadosamente la información antes de abordar. Para garantizar un proceso de embarque ágil y ordenado, se solicita a todos los pasajeros presentarse en el punto de abordaje con al menos 15 minutos de anticipación respecto a la hora programada de salida. Al momento de abordar la unidad, el pasajero deberá presentar su boleto al personal autorizado para su validación. El boleto es personal e intransferible, y su uso está sujeto a las políticas y condiciones establecidas por la empresa.
                    En caso de requerir una modificación en su itinerario, este boleto permite realizar un cambio de fecha o de horario, siempre y cuando la solicitud se realice con un mínimo de 2 horas de anticipación respecto a la hora de salida originalmente seleccionada. Las modificaciones estarán sujetas a disponibilidad en los servicios programados.
                    Es importante señalar que no se realizan devoluciones después de la fecha y hora establecidas en el boleto, ni una vez que se haya efectuado cualquier cambio en el mismo.
                    Para la seguridad y tranquilidad de nuestros pasajeros, este boleto incluye seguro de viajero, el cual aplica conforme a los términos y condiciones establecidos por la póliza correspondiente durante el trayecto.
                    En materia de comprobación fiscal, este boleto es canjeable por factura. El plazo para solicitarla comprende todo el mes en el que se realizó el viaje y hasta los primeros dos días naturales del mes siguiente. Para realizar su solicitud, deberá enviar por correo electrónico sus datos fiscales completos, así como las especificaciones necesarias para la facturación y una fotografía o copia legible de su boleto.
                    Las solicitudes de facturación deberán enviarse al siguiente correo electrónico:
                    Ventas y facturación: ventas.enlacesds@outlook.es
                    Le agradecemos su preferencia y confianza. Nuestro compromiso es brindarle un servicio seguro, puntual y de calidad en cada uno de sus viajes.
                </p>
            </div>
        </div>
    </div>

        @if(!$loop->last)
            <div class="page-break"></div>
        @endif

    @endforeach

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        /* Configuración de la página y márgenes */
        @page {
            margin: 0cm 0cm;
        }

        body {
            /* Dejamos margen superior e inferior para header y footer */
            margin-top: 3cm;
            margin-bottom: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        /* Cabecera Fija (Logo y Título) */
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #f59a69;
            color: rgb(0, 0, 0);
            text-align: center;
            line-height: 1.5cm; /* Centrar verticalmente */
            padding-top: 0.5cm; /* Ajuste visual */
        }

        /* Pie de Página Fijo (Paginación) */
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            background-color: #ecf0f1;
            color: #333;
            text-align: center;
            line-height: 1.5cm;
        }

        /* Estilos de la Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        /* TRUCO 1: Repetir encabezados en cada página */
        thead {
            display: table-header-group;
        }
        
        tfoot {
            display: table-row-group;
        }

        /* TRUCO 2: Evitar que las filas se corten por la mitad */
        tr {
            page-break-inside: avoid;
        }

        /* Zebra striping para lectura fácil */
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Utilidades */
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        
        /* Contador de páginas (CSS puro) */
        .page-number:before {
            content: "Página " counter(page);
        }
    </style>
</head>
<body>

    <header>
        <h2 style="margin:0;">Reporte de Pasajeros para la corrida {{$id}} con salida el día {{$fecha}} en el horario {{$horario}}</h2>
    </header>

    <footer>
        <span class="page-number"></span> | Generado el: {{ now()->format('d/m/Y H:i') }}
    </footer>

    <main>
        {{-- <div style="margin-bottom: 20px;">
            <strong>Filtros aplicados:</strong><br>
            Fechas: {{ request('fecha_inicio') ?? 'Inicio' }} a {{ request('fecha_fin') ?? 'Fin' }} <br>
            Tipo: {{ ucfirst(request('tipo') ?? 'Todos') }} | 
            Usuario: {{ request('usuario') ? 'Seleccionado' : 'Todos' }}
        </div> --}}

        <table>
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Pasajero</th>
                    <th width="20%">Zona de Abordaje</th>
                    <th width="15%">Usuario</th>                  
                    <th width="15%">Agencia</th>                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach($boletos as $boleto)
                    <tr>
                        <td>#{{ $boleto->id }}</td>
                        <td>{{ $boleto->pasajero_nombre }}</td>
                        <td>{{ $boleto->zona->direccion }}</td>
                        <td>{{ $boleto->venta->user->name }}</td>
                        <td>{{ $boleto->venta->agencia->nombre }}</td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </main>

</body>
</html>
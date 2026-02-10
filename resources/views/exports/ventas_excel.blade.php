<table>
    <thead>
        <tr>
            <td colspan="6" style="text-align: center; background-color: #000000; color: #ffffff; font-weight: bold;">
                REPORTE DE VENTAS - ENLACES DEL SUR
            </td>
        </tr>
        
        <tr>
            <td colspan="6" style="text-align: center;">
                Generado el: {{ now()->format('d/m/Y H:i') }}
            </td>
        </tr>

        <tr></tr>

        <tr style="background-color: #cccccc;">
            <th style="border: 1px solid #000000; ">ID</th>
            <th style="border: 1px solid #000000; ">Boletos Vendidos</th>            
            <th style="border: 1px solid #000000; ">Método de pago</th>
            <th style="border: 1px solid #000000; ">Fecha</th>
            <th style="border: 1px solid #000000; ">Usuario</th>
            <th style="border: 1px solid #000000; ">Agencia</th>
            <th style="border: 1px solid #000000; ">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)        
            <tr>
                <td style="border: 1px solid #000000; text-align: center;">{{ $venta->id }}</td>
                <td style="border: 1px solid #000000;">{{ $venta->boletos_vendidos>0 ? $venta->boletos_vendidos : 'Viaje' }}</td>
                <td style="border: 1px solid #000000;">{{ $venta->metodo_pago }}</td>
                <td style="border: 1px solid #000000;">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                <td style="border: 1px solid #000000;">{{ $venta->user->name  }}</td>
                <td style="border: 1px solid #000000;">{{ $venta->agencia->nombre }}</td>
                <td style="border: 1px solid #000000; text-align: right;">${{ $venta->total }}</td>
            </tr>
        @endforeach
    </tbody>
    
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: right; font-weight: bold;">TOTAL INGRESOS:</td>
            <td style="font-weight: bold; background-color: #ffff00;">
                ${{ number_format($ventas->sum('total'), 2) }}
            </td>
        </tr>
    </tfoot>
</table>
<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\Venta;
use App\Models\Viaje;
use App\Models\Agencia;
use App\Models\Corrida;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ViajesController extends Controller
{
    public function index()
    {
        $zonas = Zona::all();
        $agencias = Agencia::all();
        return view('viajes.viaje', [
            'zonas' => $zonas,
            'agencias' => $agencias
        ]);
    }

    public function store(Request $request)
    {
        //dd($request);        
        $zona = Zona::find($request->zona);

        $venta = Venta::create([
            'total' => $request->precio,
            'boletos_vendidos' => 0,
            'fecha'  => now()->format('Y-m-d'),
            'metodo_pago' => $request->metodoPago,
            'user_id' => auth()->id(),
            'agencia_id' => $request->agencia
        ]);

        $viaje = Viaje::create([
            'destino' => 'Apto. Tuxtla',
            'fecha'  => $request->fecha,
            'horario' => $request->horario,
            'tipo'    => $request->tipo,
            'precio'  => $request->precio,
            'nombre_cliente' => $request->nombre,
            'venta_id' => $venta->id,
            'zona_id'  => $request->zona
        ]);

        $ticket = [
            'id' => $viaje->id,
            'nombre_pasajero' => $request->nombre,                
            'destino' => 'Aeropuerto Tuxtla',
            'fecha'   => $request->fecha,
            'horario' => $request->horario,
            'tipo'    => $request->tipo,
            'precio'  => $request->precio,            
            'zona'    => $zona->direccion,
        ];

        $url = $this->generarTicketViaje($ticket, $venta->id);
        return view('ventas.boletos', ['url' => $url]);
    }

    function generarTicketViaje($ticket, $ventaId)
    {
        // 2. Cargamos la vista pasando la variable $boletos
        $pdf = Pdf::loadView('pdf.ticketViaje', ['ticket' => $ticket]);
        
        // Tip: Cambiar el tamaño de papel si quieres que se vea más como ticket
        $pdf->setPaper('A5', 'portrait');     
        // 3. Generar y Guardar
        $nombreArchivo = 'venta_' . $ventaId . '.pdf';
        //Storage::put('public/boletos/' . $nombreArchivo, $pdf->output());
        Storage::disk('public')->put('boletos/' . $nombreArchivo, $pdf->output());

        $url = Storage::disk('public')->url('boletos/' . $nombreArchivo);

        return $url;
        /* return response()->json([
            'url' => $url
        ]); */
    
    }

}

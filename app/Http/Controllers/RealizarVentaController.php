<?php

namespace App\Http\Controllers;

use Safe\url;
use App\Models\Venta;
use App\Models\Agencia;
use App\Models\Corrida;
use App\Models\Zona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Container\Attributes\Auth;

class RealizarVentaController extends Controller
{
    //
    public function index()
    {        
        return view('ventas.buscarCorridas');
    }

    public function store(Request $request)
    {
        $corridas = Corrida::where('fecha', $request->fecha)
                            ->where('boletos_disponibles', '>=', intval($request->numero_boletos))
                            ->get();        

        return view('ventas.seleccionarCorrida', ['corridas' => $corridas, 'fecha' => $request->fecha, 'numBoletos' => intval($request->numero_boletos)]);
    }

    public function pasajeros($id, $numBoletos)
    {
        $agencias = Agencia::all();
        $zonas = Zona::all();
        return view('ventas.datosPasajero', [
            'id' => $id, 
            'numBoletos' => $numBoletos, 
            'agencias' => $agencias,
            'zonas'    => $zonas
            ]
        );
    }

    public function venta(Request $request)
    {        
        //Busca la corrida y calcula el total de la venta
        $corrida = Corrida::find($request->corrida);
        $zona = Zona::find($request->zona);
        //$total = $corrida->precio_boleto * $request->boletos;
        if($corrida->boletos_disponibles < $request->boletos){
            dd("Error Boletos no Disponibles");
        }
        $total = 0;             
        //Disminuye el número de boletos disponibles en la venta      
        $corrida->boletos_disponibles -= $request->boletos;
        $corrida->save();
        //Inserta el nuevo registro en la tabla de ventas
        $venta = Venta::create([
            'total' => 0,
            'boletos_vendidos' => $request->boletos,
            'fecha'  => now()->format('Y-m-d'),
            'metodo_pago' => $request->metodoPago,
            'user_id' => auth()->id(),
            'agencia_id' => $request->agencia
        ]);        

        //Realiza la inserción en la tabla de boletos
        $boletos =[];
        for ($i=0; $i<$request->boletos; $i++){
            $pasajero='pasajero'.($i+1);            
            $tipo='tipo'.($i+1);    

            if($request->$tipo=='niño'){
                $precio = $request->precio/2; 
            }else{
                $precio = $request->precio; 
            }

            $boleto=$corrida->boletos()->create([
                'pasajero_nombre' => $request->$pasajero,
                'status' => 'vendido',
                'tipo'   => $request->$tipo,
                'precio' => $precio,
                'folio'  => '',
                'venta_id' => $venta->id,
                'zona_id'  => $zona->id
            ]);
            
            $boleto->folio = $corrida->id.$venta->id.$boleto->id;
            $boleto->save();

            $b = [
                'id' => $boleto->id,
                'nombre_pasajero' => $boleto->pasajero_nombre,                
                'destino' => 'Aeropuerto Tuxtla',
                'fecha'   => $corrida->fecha,
                'horario' => $corrida->horario,
                'tipo'    => $request->$tipo,
                'precio'  => $precio,
                'folio'   => $boleto->folio,
                'zona'    => $zona->direccion,    
            ];
            array_push($boletos, $b);

            $total+=$precio;
        }   
        
        $venta->total = $total;
        $venta->save();
        //return 
        $url = $this->generarBoletosVenta($boletos, $venta->id);
        return view('ventas.boletos', ['url' => $url]);

    }

    
    public function generarBoletosVenta($boletos, $ventaId)
    {              

        // 2. Cargamos la vista pasando la variable $boletos
        $pdf = Pdf::loadView('pdf.ticket', ['boletos' => $boletos]);
        
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

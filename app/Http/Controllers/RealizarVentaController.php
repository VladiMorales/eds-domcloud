<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use App\Models\Corrida;
use App\Models\Venta;
use App\Models\Zona;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class RealizarVentaController extends Controller
{
    //
    public function index()
    {        
        return view('ventas.buscarCorridas');
    }

    public function store(Request $request)
    {
        $corridas = Corrida::where('fecha', $request->fecha)->get();

        return view('ventas.seleccionarCorrida', ['corridas' => $corridas, 'fecha' => $request->fecha, 'numBoletos' => intval($request->numero_boletos)]);
    }

    public function pasajeros($id, $numBoletos)
    {
        $agencias = Agencia::where('status', 'activo')->get();
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
    $usuario = Auth::user();
    
    try {
        // 2. INICIAR TRANSACCIÓN DE BASE DE DATOS
        DB::beginTransaction();

        // 3. BLOQUEO PESIMISTA
        // lockForUpdate() evita que otro proceso modifique esta corrida hasta que terminemos
        $corrida = Corrida::where('id', $request->corrida)->lockForUpdate()->firstOrFail();
        $zona = Zona::findOrFail($request->zona);

        // Disminuye (o en tu caso, aumenta) el número de boletos vendidos
        $corrida->boletos_vendidos += $request->boletos;
        $corrida->save();

        // Inserta el nuevo registro en la tabla de ventas
        $venta = Venta::create([
            'total' => 0,
            'boletos_vendidos' => $request->boletos,
            'fecha'  => now()->format('Y-m-d'),
            'metodo_pago' => $request->metodoPago,
            'user_id' => $usuario->id,
            'agencia_id' => $request->agencia            
        ]);

        $boletos = [];
        $total = 0;

        // Realiza la inserción en la tabla de boletos
        for ($i = 0; $i < $request->boletos; $i++) {
            $pasajero = 'pasajero' . ($i + 1);            
            $tipo = 'tipo' . ($i + 1);    
            $precioB = 0;
            $precio = 0;

            if ($usuario->comision == 'si') {
                if ($request->precio == 250) {
                    $precio = 190;                    
                } elseif ($request->precio == 230) {
                    $precio = 210;                    
                } else {
                    $precio = $request->precio - 20;
                }
                $precioB = $request->precio;
            } else {                
                if ($request->$tipo == 'niño') {
                    $precio = $request->precio / 2;                    
                } else {
                    $precio = $request->precio;
                }
                $precioB = $precio;
            }

            $boleto = $corrida->boletos()->create([
                'pasajero_nombre' => $request->$pasajero,
                'status' => 'vendido',
                'tipo'   => $request->$tipo,
                'precio' => $precio,
                'folio'  => '', // Se actualiza justo abajo
                'venta_id' => $venta->id,
                'zona_id'  => $zona->id
            ]);
            
            // Actualizamos el folio usando el ID autoincrementable
            $boleto->folio = $corrida->id . $venta->id . $boleto->id;
            $boleto->save();

            $b = [
                'id' => $boleto->id,
                'nombre_pasajero' => $boleto->pasajero_nombre,                
                'destino' => $corrida->destino ?? 'Aeropuerto Tuxtla', // Mejor si viene de la DB
                'fecha'   => $corrida->fecha,
                'horario' => $corrida->horario,
                'tipo'    => $request->$tipo,
                'metodo_pago' => $request->metodoPago,
                'precio'  => $precioB,                
                'zona'    => $zona->direccion,    
            ];
            array_push($boletos, $b);

            $total += $precio;
        }  
        
        // Actualizamos el total de la venta
        $venta->total = $total;
        $venta->save();

        // 4. CONFIRMAR TRANSACCIÓN
        // Si llegamos hasta aquí, todo salió bien. Guardamos los cambios en la BD.
        DB::commit();

        // Generamos el PDF fuera de la transacción para no mantener la BD bloqueada
        // mientras procesamos el archivo (DOMPDF puede ser lento).
        $this->generarBoletosVenta($boletos, $venta->id);
        

        return redirect()->route('descargar.boletos', ['id' => $venta->id])
                         ->with('success', 'Venta realizada con éxito.');

    } catch (\Exception $e) {
        // 5. REVERTIR TRANSACCIÓN EN CASO DE ERROR
        DB::rollBack();               

        // Guardamos el error real en los logs para que tú puedas revisarlo después
        Log::error('Error al procesar la venta: ' . $e->getMessage(), [
            'usuario_id' => $usuario->id,
            'corrida_id' => $request->corrida
        ]);

        // Retornamos un mensaje amigable al usuario
        return back()->with('error', 'Ocurrió un error inesperado al procesar la venta. Por favor, intenta de nuevo.');
    }
}
    public function imprimirBoletos($id)
    {
        $nombreArchivo = 'venta_' . $id . '.pdf';
        $url = Storage::disk('public')->url('boletos/' . $nombreArchivo);
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
        
        Storage::disk('public')->put('boletos/' . $nombreArchivo, $pdf->output());                        
    }
}

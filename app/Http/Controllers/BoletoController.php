<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Corrida;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BoletoController extends Controller
{
    public function index()
    {
        return view('boletos.boletos');
    }

    public function encontrarVenta(Request $request)
    {

        $boleto = Boleto::find($request->id);
        if (!$boleto){
            return redirect()->route('boletos.gestion')->with('mensaje', 'noexiste');
        }
        $fecha = Carbon::parse($boleto->corrida->fecha);
        $horario = Carbon::parse($boleto->corrida->horario);
        if($boleto->corrida->ya_salio){
            return redirect()->route('boletos.gestion')->with('mensaje', 'invalido');
        }else{            
            $venta = Venta::find($boleto->venta_id);
            $boletos = Boleto::where('venta_id', $venta->id)->get();
            $corrida = $boletos[0]['corrida_id'];            
        
            return view('boletos.boletos_info', ['boletos' => $boletos, 'venta' => $venta, 'corrida' => $corrida]);
        }

        
    }

    public function cancelarVenta($idVenta, $idCorrida)
    {
        $corrida = Corrida::find($idCorrida);
        $venta = Venta::find($idVenta);
        $corrida->boletos_vendidos -= $venta->boletos_vendidos;
        $corrida->save();
        
        $venta->delete();

        return redirect()->route('boletos.gestion')->with('mensaje', 'eliminado');
    }

    public function escogerCorrida($id)
    {
        $venta = Venta::find($id);
        return view('boletos.buscarCorridas', ['venta' => $venta]);
    }

    public function buscarCorridas(Request $request)
    {
        $corridas = Corrida::where('fecha', $request->fecha)->get();
        $venta = Venta::find($request->id_venta);
        return view('boletos.seleccionarCorrida', [
            'corridas' => $corridas, 
            'fecha' => $request->fecha, 
            'venta' => $venta]);
    }

    public function seleccionarCorrida($idV, $idC)
    {
        $venta = Venta::find($idV);
        $boletos = $venta->boletos;
        $corridaNueva = Corrida::find($idC);
        $corridaAnterior = Corrida::find($boletos[0]['corrida_id']);

        $corridaNueva->boletos_vendidos += $venta->boletos_vendidos;
        $corridaNueva->save();
        $corridaAnterior->boletos_vendidos -= $venta->boletos_vendidos;
        $corridaAnterior->save();

        $tickets = [];

        foreach($boletos as $boleto)
        {
            $boleto->corrida_id = $idC;
            $boleto->save();

            $b = [
                'id' => $boleto->id,
                'nombre_pasajero' => $boleto->pasajero_nombre,                
                'destino' => 'Aeropuerto Tuxtla',
                'fecha'   => $corridaNueva->fecha,
                'horario' => $corridaNueva->horario,
                'tipo'    => $boleto->tipo,
                'metodo_pago' =>$venta->metodoPago,
                'precio'  => $boleto->precio,                
                'zona'    => $boleto->zona->direccion,    
            ];

            array_push($tickets, $b);
        }

        $this->generarBoletosVenta($tickets, $venta->id);
        
        return redirect()->route('descargar.boletos.cambio', ['id'=> $venta->id]);
    }

    public function imprimirBoletos($id)
    {
        $nombreArchivo = 'venta_' . $id . '.pdf';
        $url = Storage::disk('public')->url('boletos/' . $nombreArchivo);
        return view('boletos.descargar_boletos', ['url' => $url]);
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

/*         $url = Storage::disk('public')->url('boletos/' . $nombreArchivo);

        return $url; */
        /* return response()->json([
            'url' => $url
        ]); */
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Corrida;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

    
}

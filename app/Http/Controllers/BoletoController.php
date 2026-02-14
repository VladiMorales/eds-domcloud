<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
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
        $fecha = Carbon::parse($boleto->corrida->fecha);
        $horario = Carbon::parse($boleto->corrida->horario);
        if($boleto->corrida->ya_salio){
            return redirect()->route('boletos.gestion')->with('mensaje', 'invalido');
        }else{            
            $venta = Venta::find($boleto->venta_id);
            $boletos = Boleto::where('venta_id', $venta->id)->get();
        
            return view('boletos.boletos_info', ['boletos' => $boletos, 'venta' => $venta]);
        }

        
    }
}

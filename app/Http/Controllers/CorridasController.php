<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CorridasController extends Controller
{
    public function index()
    {                
        $corridas = Corrida::where('boletos_disponibles', '>', 0)->where('fecha', Carbon::now()->format('Y-m-d'))->get();        
        return view('corridas.corridas', ["corridas" => $corridas]);
    }

    public function store(Request $request)
    {        
        $request->validate([
            'fecha'     => 'required', 
            'horario' => 'required',             
        ]);

        Corrida::create([
            'destino'        => 'Apto. Tuxtla',
            'fecha'          => $request->fecha,
            'horario'        => $request->horario,            
            'boletos_disponibles' => 14
        ]);

        return redirect()->route('corridas')->with('mensaje', 'creado');
    }

    public function destroy($id)
    {       
        $corrida = Corrida::find($id);

        $corrida->delete();

        return redirect()->route('corridas')->with('mensaje', 'eliminado');
    }

    public function update(Request $request, $id)
    {
        $corrida = Corrida::find($id);

        $corrida->fecha = $request->fecha;
        $corrida->horario = $request->horario;
        /* $corrida->precio_boleto = $request->precio_boleto; */
        $corrida->save();

        return redirect()->route('corridas')->with('mensaje', 'editado');
    }
}

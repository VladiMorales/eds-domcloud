<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Corrida;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CorridasController extends Controller
{
    public function index()
    {                
        $corridas = Corrida::where('fecha', Carbon::now()->format('Y-m-d'))->get();        
        return view('corridas.corridas', ["corridas" => $corridas]);
    }

    public function filtrar(Request $request)
    {
        $corridas = Corrida::whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])->get();        
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
            'boletos_vendidos' => 0
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

    public function boletos($id)
    {
        $boletos = Boleto::where('corrida_id', $id)->get();
        $corrida = Corrida::find($id);
        $fecha = Carbon::parse($corrida->fecha)->format('d/m/y');
        $horario = Carbon::parse($corrida->horario)->format('H:i');
        $pdf = Pdf::loadView('exports.pasajeros_pdf', ['boletos' => $boletos, 'id' => $id, 'fecha' => $fecha, 'horario' => $horario])
            ->setPaper('a4'); 

        return $pdf->download('pasajeros_corrida_'.$id.'.pdf');
    }
}

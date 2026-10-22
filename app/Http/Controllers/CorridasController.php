<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\Corrida;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class CorridasController extends Controller
{
    public function index()
    {                
        $corridas = Corrida::with('unidad')->where('fecha', Carbon::now()->format('Y-m-d'))->get();
        $unidades = Unidad::orderBy('numero', 'desc')->get();  
        return view('corridas.corridas', ["corridas" => $corridas, 'unidades' => $unidades]);
    }

    public function filtrar(Request $request)
    {
        $corridas = Corrida::whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin])->get();        
        $unidades = Unidad::orderBy('numero', 'desc')->get();  
        return view('corridas.corridas', ["corridas" => $corridas, 'unidades' => $unidades]);
    }

    public function store(Request $request)
    {        
        $request->validate([
            'fecha'     => 'required', 
            'horario' => 'required', 
            'unidad' => 'required'            
        ]);

        $unidad = ($request->unidad == -1) ? null : $request->unidad;
    
        Corrida::create([
            'destino'        => 'Apto. Tuxtla',
            'fecha'          => $request->fecha,
            'horario'        => $request->horario,            
            'boletos_vendidos' => 0,
            'unidad_id' => $unidad
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
        $corrida->save();

        return redirect()->route('corridas')->with('mensaje', 'editado');
    }

    public function updateUnidad (Request $request, $id)
    {        
        $corrida = Corrida::find($id);
        $unidad = ($request->unidad == -1) ? null : $request->unidad;
        $corrida->unidad_id = $unidad;
        $corrida->save();

        return redirect()->route('corridas')->with('mensaje', 'editado');
    }

    public function boletos($id)
    {
        $boletos = Boleto::where('corrida_id', $id)->get();
        $ordenados = $boletos->sortBy(function($item) {
            return $item->zona->direccion;
        });
        $corrida = Corrida::find($id);
        $fecha = Carbon::parse($corrida->fecha)->format('d/m/y');
        $horario = Carbon::parse($corrida->horario)->format('H:i');
        $pdf = Pdf::loadView('exports.pasajeros_pdf', ['boletos' => $ordenados, 'id' => $id, 'fecha' => $fecha, 'horario' => $horario])
            ->setPaper('a4'); 

        return $pdf->download('pasajeros_corrida_'.$id.'.pdf');
    }
}

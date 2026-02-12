<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use Illuminate\Http\Request;

class AgenciaController extends Controller
{
    //
    public function index()
    {
        $agencias = Agencia::all();
        return view('agencias.agencias', ['agencias' => $agencias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required',                        
        ]);

        Agencia::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('agencias')->with('mensaje', 'creado');
    }

    public function destroy($id)
    {
        $agencia = Agencia::find($id);

        $agencia->delete();

        return redirect()->route('agencias')->with('mensaje', 'eliminado');
    }

    public function update(Request $request, $id){
        $agencia = Agencia::find($id);

        $agencia->nombre = $request->nombre;

        $agencia->save();

        return redirect()->route('agencias')->with('mensaje', 'editado');
    }
}

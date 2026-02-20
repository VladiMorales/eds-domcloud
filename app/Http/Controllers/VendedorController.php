<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return view('vendedores.vendedores', ['vendedores' => $vendedores]);
    }

    public function store(Request $request)
    {        
        $request->validate([
            'nombre'     => 'required',                        
        ]);

        Vendedor::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('vendedores')->with('mensaje', 'creado');
    }

    public function update(Request $request, $id)
    {
        $vendedor = Vendedor::find($id);        
        $vendedor->nombre = $request->nombre;
        $vendedor->save();

        return redirect()->route('vendedores')->with('mensaje', 'editado');
    }

    public function destroy($id)
    {
        $vendedor = Vendedor::find($id);
        $vendedor->delete();

        return redirect()->route('vendedores')->with('mensaje', 'eliminado');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportesVendedorController extends Controller
{
    public function index(Request $request)
    {
        if(count($request->all()) === 0){
            $usuario = User::find(Auth::id());
            $boletos = $usuario->boletos()
                    ->where('ventas.fecha', now()->format('Y-m-d') )
                    ->get();
            $boletosVendidos = $usuario->boletos()
                    ->where('ventas.fecha', now()->format('Y-m-d') )
                    ->count();
            $total = $usuario->boletos()
                    ->where('ventas.fecha', now()->format('Y-m-d') )
                    ->sum('precio');
            
        }
        return view('reportes.reportes_vendedor', [
                'boletos' => $boletos, 
                'boletosVendidos' => $boletosVendidos,
                'total' => $total
            ]);
    }

    public function filtrar(Request $request)
    {       
        return redirect()->route('reportes.vendedor', $request->all());               
    }
}

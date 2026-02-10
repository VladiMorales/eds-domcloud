<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Venta;
use App\Models\Boleto;
use App\Models\Agencia;
use App\Exports\VentaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{
    public function index()
    {
        $boletos = Venta::where('fecha', now()->format('Y-m-d') )->sum('boletos_vendidos');
        $ingresos = Venta::where('fecha', now()->format('Y-m-d') )->sum('total');
        $ventas = Venta::where('fecha', now()->format('Y-m-d'))->get();
        $usuarios = User::all();
        $agencias = Agencia::all();
        return view('reportes.reporte', [
            'boletos' => $boletos,
            'ingresos' => $ingresos,
            'ventas'  => $ventas,
            'usuarios' => $usuarios,
            'agencias' => $agencias
        ]);
    }

    public function filtrar(Request $request)
    {        
        //$boletos = Venta::where('fecha', now()->format('Y-m-d') )->sum('boletos_vendidos');
        //$ingresos = Venta::where('fecha', now()->format('Y-m-d') )->sum('total');
        $usuarios = User::all();
        $agencias = Agencia::all();

        $ventas = Venta::query()
                ->aplicarFiltros($request->all()) 
                ->get();
        
        $boletos = Venta::query()
                ->aplicarFiltros($request->all()) 
                ->sum('boletos_vendidos');
        
        $ingresos = Venta::query()
                ->aplicarFiltros($request->all()) 
                ->sum('total');
        

        return view('reportes.reporte', [            
            'boletos' => $boletos,
            'ingresos' => $ingresos,
            'ventas'  => $ventas,
            'usuarios' => $usuarios,
            'agencias' => $agencias
        ]);
    }

    public function descargarExcel(Request $request)
    {
        $ventas = Venta::query()->aplicarFiltros($request->all())->get();

        // 2. Generamos el Excel pasando los datos
        return Excel::download(new VentaExport($ventas), 'reporte_ventas.xlsx');
    }
}

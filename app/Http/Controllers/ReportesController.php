<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Boleto;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index()
    {
        $boletos = Venta::where('fecha', now()->format('Y-m-d') )->sum('boletos_vendidos');
        $ingresos = Venta::where('fecha', now()->format('Y-m-d') )->sum('total');
        $ventas = Venta::where('fecha', now()->format('Y-m-d'))->get();

        return view('reportes.reporte', [
            'boletos' => $boletos,
            'ingresos' => $ingresos,
            'ventas'  => $ventas
        ]);
    }
}

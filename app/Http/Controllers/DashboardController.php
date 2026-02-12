<?php

namespace App\Http\Controllers;

use App\Models\Boleto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $boletos = Boleto::latest()->take(10)->get();
        return view('dashboard.dashboard', ['boletos' => $boletos]);
    }
}

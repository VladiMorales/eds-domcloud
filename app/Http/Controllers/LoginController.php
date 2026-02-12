<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // Si ya está autenticado, redirigir al dashboard
        }
        return view('auth.login');        
    }

    public function store(Request $request)
    {
     
        $request->validate([            
            'username' => 'required', 
            'password' => 'required',             
        ]);

        if(!Auth::attempt([
            'username' => $request->username, 
            'password' => $request->password
        ])){
            //Redirigimos con error
            return back()->with('mensaje', 'incorrecto');
        }

        return redirect()->route('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
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
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('dashboard');
    }
}

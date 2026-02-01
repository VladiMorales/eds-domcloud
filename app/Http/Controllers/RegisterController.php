<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name'     => 'required', 
            'username' => 'required|unique:users', 
            'password' => 'required|confirmed', 
            'tipo'     => 'required'
        ]);

        User::create([
            'name'  => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'tipo'     => $request->tipo
        ]);

        return redirect()->route('login')->with('mensaje', 'creado');
    }
}

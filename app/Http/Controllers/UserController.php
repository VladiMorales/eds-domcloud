<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {        
        $usuarios = User::where('status', 'activo')->paginate(10);
        return view('usuarios.usuarios', ["usuarios" => $usuarios]);
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

        return redirect()->route('usuarios')->with('mensaje', 'creado');
    }

    public function destroy($id)
    {        
        $usuario = User::find($id);

        $usuario->status = 'inactivo';
        $usuario->save();

        return redirect()->route('usuarios')->with('mensaje', 'eliminado');
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);

        $usuario->name = $request->name;
        $usuario->username = $request->username;
        $usuario->tipo = $request->tipo;
        $usuario->save();

        return redirect()->route('usuarios')->with('mensaje', 'editado');
    }
}

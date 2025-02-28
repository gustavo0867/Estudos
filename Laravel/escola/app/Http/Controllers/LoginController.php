<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController {
    public function showLogin()
{   
    return redirect()->route('escola.cronograma');
    
}

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = DB::table('usuario')->where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['email' => 'Credenciais inválidas!']);
        }

        session(['admin' => true]); // Cria a sessão de admin
        
        return view('escola.index');
    }

    public function logout()
    {
        session()->forget('admin'); // Remove sessão
        return redirect('/login');
    }
}

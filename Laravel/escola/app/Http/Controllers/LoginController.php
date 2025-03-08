<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller {


    public function auth(Request $request){
        
            $credenciais = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        
        

        if(Auth::attempt($credenciais)){
            $request->session()->regenerate();
            return redirect()->intended('cronograma');

        }else{
            return redirect()->back()->with('erro', 'Usuário ou senha inválidos');
        }

    }

    /*
    public function showLogin()
    {   
        return view('escola.login');
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
    */
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Admin;

class AdminSessionController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            "cpf" => "required",
            "senha" => "required"
        ]);
        
        $admin = Admin::where("cpf", $request['cpf'])->get()->first();

        if(!isset($admin)) {
            return back()->withErrors([
                "mensagem" => "O Email informado ou não existe em nossos sistema"
            ]);
        }

        if($request['cpf'] !== $admin->cpf || $request['senha'] !== $admin->senha) {
            return back()->withErrors([
                "credenciais_incorretas" => "As credenciais informadas não estão corretas."
            ]);
        }
        
    }

    public function logout(Request $request) {
        $request->session()->forget("session_token");
        $request->session()->flush();
        
        return redirect()->route("login");
    }
}

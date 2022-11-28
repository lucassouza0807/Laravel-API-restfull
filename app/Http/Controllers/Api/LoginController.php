<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use Error;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        
        $usuario = Cliente::where("email", $request->email)->get()->first();
        
        if (is_null($usuario)) {
            return response()->json([
                "success" => false,
                "error_type" => "email",
                "message" => "Não foi possível econtrar sua conta em nosso sistema"
            ]);
        }

        if (Hash::check($request->password, $usuario->password, ["rounds" => 12])) {
            return response()->json([
                "success" => true,
                "cliente_id" => $usuario->usuario_id,
                "cliente_nome" => $usuario->nome,
                "token" => $usuario->createToken("user_token")->plainTextToken
            ]);
        } else {
            return response()->json([
                "success" => false,
                "error_type" => "password",
                "message" => "A senha informada está incorreta",
            ]);
        }
    }
 
    public function logout(Request $request): void
    {
        $usuario = Cliente::where("cliente_id", $request->cliente_id)->get()->first();

        $usuario->tokens()->delete();
    }
}

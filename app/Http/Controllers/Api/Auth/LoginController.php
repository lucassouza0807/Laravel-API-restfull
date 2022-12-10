<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $usuario = Cliente::where("email", $request->email)->get()->first();

        if (!$usuario) {
            return response()->json([
                "success" => false,
                "error_type" => "email",
                "message" => "Os dados informados não correspondem no nosso sistema."
            ]);
        }

        if (Hash::check($request->password, $usuario->password, ["rounds" => 12])) {
            return response()->json([
                "success" => true,
                "cliente_id" => $usuario->usuario_id,
                "cliente_nome" => $usuario->nome,
                "token" => $usuario->createToken("user_token", ["can-read", "can-update"])->plainTextToken
            ]);
        }

        return response()->json([
            "success" => false,
            "error_type" => "password",
            "message" => "A senha informada está incorreta",
        ], 401);
    }

    public function logout($id): void
    {
        $usuario = Cliente::where("usuario_id", $id)->get()->first();

        $usuario->tokens()->delete();
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $usuario = User::where("email", $request->email)->get()->first();

        if (!$usuario) {
            return response()->json([
                "success" => false,
                "message" => "Os dados informados não correspondem no nosso sistema.",
            ]);
        }

        if (Hash::check($request->password, $usuario->password, ["rounds" => 12])) {
            if($usuario->is_active == false) {
                return response()->json([
                    "success" => false,
                    "message" => "Ops parece que você ainda não ativou sua conta! verifique seu Email."
                ]);
            }

            return response()->json([
                "success" => true,
                "token" => $usuario->createToken("user_token", ["can-read", "can-update"])->plainTextToken,
                "user" => [
                    "User_id" => $usuario->usuario_id,
                    "nome" => $usuario->nome,
                    "email" => $usuario->email
                ]
            ]);
        }

        return response()->json([
            "success" => false,
            "message" => "A senha informada está incorreta",
        ]);
    }

    public function logout($id): void
    {
        $usuario = User::where("usuario_id", $id)->get()->first();

        $usuario->tokens()->delete();
    }
}
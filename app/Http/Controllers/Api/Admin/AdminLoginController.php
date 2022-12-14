<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $admin = Admin::where("matricula", $request->matricula)->get()->first();

        if (!$admin) {
            return response()->json([
                "success" => false,
                "error_type" => "email",
                "message" => "Funcionario não existe ou não consta no cadastro da empresa"
            ]);
        }

        if (Hash::check($request->password, $admin->password, ["rounds" => 12])) {
            return response()->json([
                "success" => true,
                "cliente_id" => $admin->usuario_id,
                "cliente_nome" => $admin->nome,
                "token" => $admin->createToken("user_token", ["can-read-stock", "can-order-stock", "can-update-stock", "can-register-stock"])->plainTextToken
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
        $usuario = Admin::where("usuario_id", $id)->get()->first();

        $usuario->tokens()->delete();
    }
}

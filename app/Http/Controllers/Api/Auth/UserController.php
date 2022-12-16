<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function getUserInfo($user_id)
    {
        $token = PersonalAccessToken::where('tokenable_id', $user_id)->first();

        $user = $token->tokenable;

        return $user;
    }

    public function activateAccount($token)
    {
        $cliente = Cliente::where("activate_token", $token)->get()->first();

        if (!$cliente) {
            return response()->json([
                "message" => "Token invalido"
            ]);
        }

        if ($cliente->is_active == true) {
            return response()->json([
                "message" => "Usuario já ativado"
            ]);
        }

        $cliente->is_active = true;
        $cliente->save();
        return response()->json(["message" => "usuario ativado com sucesso"]);
        
    }
}

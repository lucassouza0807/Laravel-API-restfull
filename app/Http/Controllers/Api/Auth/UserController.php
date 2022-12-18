<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function getUserInfo($user_id)
    {

        $user = Cache::remember("user-ifo", 60 * 60 * 1, function() use ($user_id) {
            $user_query = PersonalAccessToken::where('tokenable_id', $user_id)->first();

            return $user_query->tokenable;
        });
        
        return view("teste", ["user_info", $user]);
    }

    public function activateAccount($token)
    {
        $cliente = Cliente::where("activate_token", $token)->get()->first();

        if (!$cliente) {
            return response()->json([
                "message" => "Token inválido"
            ]);
        }

        if ($cliente->is_active == true) {
            return response()->json([
                "message" => "Usuário já ativado!"
            ]);
        }

        $cliente->is_active = true;
        $cliente->save();
        return response()->json(["message" => "Usuário ativado com sucesso!"]);
    }
}

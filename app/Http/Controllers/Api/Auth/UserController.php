<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\QueryException;


class UserController extends Controller
{
    public function getUserInfo($user_id)
    {

        $user = PersonalAccessToken::where('tokenable_id', $user_id)->first();

        if (!$user) {
            return response()->json([
                "message" => "token não pertence a esse usuario"
            ]);
        }

        return $user->tokenable;

    }

    public function activateAccount($token)
    {
        $cliente = User::where("activation_token", $token)->get()->first();

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

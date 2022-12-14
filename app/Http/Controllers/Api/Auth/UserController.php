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
}
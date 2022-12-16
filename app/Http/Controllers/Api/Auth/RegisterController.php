<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $activate_token = Str::random(32);

        try {
            $request->validate([
                "nome" => "required|string|max:100",
                "sobrenome" => "required|string|max:100",
                "email" => "required|email",
                "password" => "required|min:8",
            ]);

            Cliente::create([
                "nome" => $request->nome,
                "sobrenome" => $request->sobrenome,
                "email" => $request->email,
                "password" => Hash::make($request->password, ["rounds" => 12]),
                "activate_token" => $activate_token,
                "is_active" => false
            ]);

            Mail::to($request->email)->send(new AccountCreated($request->nome, $activate_token));

            return response()->json([
                "success" => true,
                "message" => "Usuario criado com sucesso"
            ]);
        } catch (ValidationException $message) {
            return response()->json([
                "success" => false,
                "validationException" => $message->errors()
            ]);
        } catch (QueryException $error) {
            return $error->getCode() == 23000
                ? response()->json(["error" => "O Email informado já está em uso"])
                : response()->json(["error" => "Erro interno"], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                "nome" => "required",
                "sobrenome" => "required",
                "email" => "required|email",
                "password" => "required|min:8",
            ]);

            Cliente::create([
                "nome" => $request->nome,
                "sobrenome" => $request->sobrenome,
                "email" => $request->email,
                "password" => Hash::make($request->password, ["rounds" => 12]),
                "is_active" => false
            ]);

            return response()->json([
                "success" => "Usuario criado com sucesso"
            ]);

        } catch (ValidationException $message) {
            return response()->json([
                "validationException" => $message->errors()
            ]);
        } catch (QueryException $error) {

            return $error->getCode() == 23000
                ? response()->json(["error" => "O Email informado já está em uso"])
                : response()->json(["error" => "Erro interno"])->status(500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Models\Cliente;
use Illuminate\Support\Str;
use App\Jobs\SendActivationEmail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        /**
         * After user creates a new account this variable generate a random token and saves in database,
         * With this token the apllication creates a link to user activate your account
         * Example: http://localhost:3000/activate_account/DKQhPfJcED5C3RGHehVUtbXEOJEXkAGG <--token
         */

        $activation_token = Str::random(32); //http://localhost:3000/activate_account/DKQhPfJcED5C3RGHehVUtbXEOJEXkAGG

        try {
            $request->validate([
                "nome" => "required|string|max:100",
                "sobrenome" => "required|string|max:100",
                "email" => "required|email",
                "password" => "required|min:8|confirmed",
            ]);

            Cliente::create([
                "nome" => $request->nome,
                "sobrenome" => $request->sobrenome,
                "email" => $request->email,
                "password" => Hash::make($request->password, ["rounds" => 12]),
                "activate_token" => $activation_token,
                "is_active" => false
            ]);

            $email_details = [
                "nome" => $request->nome,
                "email" => $request->email,
                "token" => $activation_token
            ];

            SendActivationEmail::dispatch($email_details);

            return response()->json([
                "success" => true,
            ]);
        } catch (ValidationException $message) {
            return response()->json([
                "success" => false,
                "error" => $message->errors()
            ]);
        } catch (QueryException $error) {
            return $error->getCode() == 23000
                ? response()->json([
                    "error" => [
                        "email" => "O Email informado já está em uso"
                    ],
                    "success" => false
                ])
                : response()->json(["error" => "Erro interno"], 500);
        }
    }
}

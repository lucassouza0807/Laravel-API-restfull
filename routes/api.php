<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\CatalogoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'apiSecret'], function () {
    Route::get("/user", function () {
        return response()->json(["mensagem" => "Middleware"]);
    });

    Route::get("v1/produtos/index", [CatalogoController::class, "index"]);

    Route::get("v1/produto/{produto_nome}", [CatalogoController::class, "pesquisarProdutoPorNome"]);
});


Route::group(['middleware' => 'apiSecret', "prefix" => "v1"], function () {
    Route::post("/login", [LoginController::class, "login"]);

    Route::post("/logout", [LoginController::class, "logout"]);

    Route::post("/register", [RegisterController::class, "register"]);

    Route::post("/update", [RegisterController::class, "register"]);
});

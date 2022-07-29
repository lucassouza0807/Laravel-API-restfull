<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
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

Route::middleware(['apiSecret'])->group(function () {
    Route::get("/user", function () {
        return response()->json(["mensagem" => "Middleware"]);
    });

    Route::get("v1/produtos/index", [CatalogoController::class, "index"]);

    Route::get("v1/produto/{produto_nome}", [CatalogoController::class, "pesquisarProdutoPorNome"]);
});


Route::middleware(['apiSecret'])->group(function () {
    Route::post("v1/login", [LoginController::class, "login"]);

    Route::post("v1/logout", [LoginController::class, "logout"]);

    
});

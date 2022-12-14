<?php header("Content-type: text/html; charset=utf-8");

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Products\ProductCatalogController;
use App\Http\Controllers\Api\Auth\UserController;
use App\Helpers\JWTDecoder;

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
    Route::get("v1/products/index", [ProductCatalogController::class, "index"]);

    Route::get("v1/products/{product_name}", [ProductCatalogController::class, "searchByProductName"]);
});

Route::group(['middleware' => ["auth:sanctum", "abilities:is-admin, can:*"], "prefix" => "admin"], function () {
});

Route::group(['middleware' => "auth:sanctum", "prefix" => "v1"], function () {
    Route::get("/user/{user_id}", [UserController::class, "getUserInfo"]);
});

Route::group(['middleware' => 'apiSecret', "prefix" => "v1"], function () {
    Route::post("/login", [LoginController::class, "login"]);

    Route::post("/logout/{id}", [LoginController::class, "logout"]);

    Route::post("/register", [RegisterController::class, "register"]);

    Route::post("/update", [RegisterController::class, "register"]);
});


Route::get("/teste-jwt", function (Request $request) {
    $token = $request->header('JWT');

    return JWTDecoder::handle($token);

    //return response()->json(["nome" => "Lucas"]);
});

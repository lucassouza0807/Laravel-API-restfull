<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Resources\Produtos;
use App\Models\Admin;
use App\Providers\PDFServiceProvider;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use App\Mail\TestEmail;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Mail;
use App\Models\Cliente;

Route::get("/teste/{user_id}",[UserController::class, "getUserInfo"]);

Route::get("active_account/{token}", function ($token) {
    
});

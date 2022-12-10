<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductStockController extends Controller
{
    public function registerNewProductInStock(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "price" => "required|numeric",
                "quantity" => "required",
                "description" => "required",
                "category" => "required",
            ]);

            Products::create([]);

        } catch (\Illuminate\Validation\ValidationException $message) {
            return response()->json([
                "validation" => $message->errors(),
            ]);
        }
    }
}

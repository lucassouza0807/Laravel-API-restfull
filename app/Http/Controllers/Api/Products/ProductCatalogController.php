<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Resources\ProductCatalogResource;

class ProductCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCatalogResource::collection(Products::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchByProductName(Request $request, $product_name)
    {
        $product_query = Products::where("name", "like",  "$product_name%");

        $mensagem = "Desculpe mas o produto que você procura ainda não está dispónivel em nossa loja";

        //ordernação
        if ($request->query("sort")) {
            switch ($request->query("sort")) {
                case "preco":
                    return ProductCatalogResource::collection($product_query->orderBy("price")->paginate(10));
                    break;

                case "preco_desc":
                    return ProductCatalogResource::collection($product_query->orderBy("price", "DESC")->paginate(10));
                    break;

                default:
                    ProductCatalogResource::collection($product_query->paginate(10));
                    break;
            }
        }

        return $product_query->count() == 0
            ? response()->json(["mensagem" => $mensagem])
            : ProductCatalogResource::collection($product_query->paginate(10));
    }
}
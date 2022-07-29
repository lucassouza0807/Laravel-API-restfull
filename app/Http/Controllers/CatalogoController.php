<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use GuzzleHttp\Handler\Proxy;
use App\Http\Resources\CatalogoResource;
use PhpParser\Node\Stmt\Break_;
use Svg\Tag\Rect;

class CatalogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CatalogoResource::collection(Produtos::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisarProdutoPorNome(Request $request, $produto_nome)
    {
        $produtosQuery = Produtos::where("produto_nome", "like",  "$produto_nome%");

        $mensagem = "Desculpe mas o produto que você procura ainda não está dispónivel em nossa loja";

        //ordernação
        if ($request->query("sort")) {
            switch ($request->query("sort")) {
                case "preco":
                    return CatalogoResource::collection($produtosQuery->orderBy("preco")->paginate(10));
                    break;

                case "preco_desc":
                    return CatalogoResource::collection($produtosQuery->orderBy("preco", "DESC")->paginate(10));
                    break;

                default:
                    CatalogoResource::collection($produtosQuery->paginate(10));
                    break;
            }
        }

        return $produtosQuery->count() == 0 ? response()->json(["mensagem" => $mensagem]) : CatalogoResource::collection($produtosQuery->paginate(10));
    }
}

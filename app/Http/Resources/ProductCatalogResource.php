<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCatalogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "produto_id" => $this->produto_id,
            "produto_nome" => $this->produto_nome,
            "produto_descricao" => $this->produto_descricao,
            "marca" => $this->marca,
            "preco" => $this->preco,
            "categoria" => $this->categoria,
            "imagem_path" => $this->imagem_path
        ];
    }
}

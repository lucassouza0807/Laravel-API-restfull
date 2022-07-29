<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = "pedidos";
    protected $primaryKey = "pedido_id";

    public function user()
    {
        return $this->belongsTo(User::class, "usuario_id");
    }
}

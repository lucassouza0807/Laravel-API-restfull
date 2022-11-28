<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Produtos extends Model
{
    use HasFactory;

    protected $table = "produtos";
    protected $primaryKey = "produto_id";

    protected $fillable = [
        
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "product_id";

    protected $fillable = [
        "name",
        "description",
        "price",
        "category",
        "sub_category",
        "quatity"
    ];

}

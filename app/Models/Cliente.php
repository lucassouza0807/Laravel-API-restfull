<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = "usuarios";
    protected $primaryKey = "usuario_id";

    protected $fillable = [
        'nome',
        'email',
        'sobrenome',
        'password',
        "is_active"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'senha'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function pedidos()
    {
        return $this->HasMany(Pedidos::class, "usuario_id");
    }
}
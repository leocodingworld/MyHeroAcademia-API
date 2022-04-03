<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Model;

class Usuario extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = "usuarios";
    protected $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;

    protected $attributes = [
        "activo" => false
    ];

    protected $fillable = [
        "nombre",
        "apellidos",
        "direccion",
        "telefono",
        "password",
        "activo"
    ];

    protected $hidden = [
        "password"
    ];
}

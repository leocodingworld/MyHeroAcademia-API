<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
	use HasFactory, HasApiTokens;

	protected $table = "usuarios";
	protected $primaryKey = "id";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"dni",
		"nombre",
		"apellidos",
		"direccion",
		"municipio",
		"localidad",
		"provincia",
		"codigoPostal",
		"telefono",
		"fechaNacimiento",
		"email",
		"password", // Cambiar de sitio
		"nivel"
	];

	protected $hidden = [
		"password"
	];
}

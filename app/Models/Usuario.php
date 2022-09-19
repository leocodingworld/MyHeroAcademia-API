<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
	use HasFactory, HasApiTokens;

	protected $table = "usuarios";
	protected $primaryKey = "id";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"id",
		"dni",
		"nombre",
		"apellidos",
		"sexo",
		"direccion",
		"municipio",
		"localidad",
		"provincia",
		"codigoPostal",
		"telefono",
		"fechaNacimiento",
		"email",
		"nivel",
		"password",
		"activo"
	];

	protected $hidden = [
		"password"
	];
}

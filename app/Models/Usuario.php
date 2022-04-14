<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Tipo;

class Usuario extends Authenticatable
{
	use HasFactory, HasApiTokens;

	protected $table = "usuarios";
	protected $primaryKey = "idUsuario";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"nombre",
		"apellidos",
		"direccion",
		"telefono",
		"password",
		"tipo",
		"activo"
	];

	public function tipo() {
		return $this -> hasMany(Tipo::class, "tipo");
	}

	protected $hidden = [
		// "idUsuario",
		"password"
	];
}

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
		"nombre",
		"email",
		"nivel",
		"password",
		"activo"
	];

	protected $hidden = [
		"password"
	];

	public function datos() {
		return $this -> belongsTo(DatosUsuario::class, "id", "id");
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DatosUsuario extends Model
{
    use HasFactory;

	protected $table = "datosUsuarios";
	protected $primaryKey = "id";
	public $incrementing = false;
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
		"fechaNacimiento"
	];

	public function user() {
		return $this -> hasOne(Usuario::class, "id", "id");
	}
}

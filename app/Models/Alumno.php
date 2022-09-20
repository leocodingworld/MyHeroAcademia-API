<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
	protected $table = "alumnos";
	protected $primaryKey = "id";
	public $incrementing = false;
	public $timestamps = false;

	protected $filliable = [
		"id",
		"matriculado", // ???
		"anho"
	];

	public function info() {
		return $this -> belongsTo(DatosUsuario::class, "id", "id");
	}

	public function expediente() {
		return $this -> hasOne(Expediente::class, "expediente", "id");
	}

	public function notas() {
		return $this -> hasMany(Nota::class, "alumno", "id");
	}
}

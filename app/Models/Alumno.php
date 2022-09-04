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
		"fechaMatricula"
	];

	public function info() {
		return $this -> belongsTo(Usuario::class, "id", "id");
	}

	public function expediente() {
		return $this -> hasOne(Expediente::class, "expediente", "id");
	}

	 public function modulos() {
		return $this
			-> belongsToMany(Modulo::class, "alumnomodulo", "modulo", "alumno");
	 }
}

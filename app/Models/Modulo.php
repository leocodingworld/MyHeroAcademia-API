<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
	protected $table = "modulos";
	protected $primaryKey = "id";
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		"id",
		"idCurso",
		"nombre",
		"nombreCorto",
		"nivel",
		"tutor",
		"horas",
	];

	public function curso() {
		return $this -> belongsTo(Curso::class, "idCurso", "id");
	}

	public function alumnos() {
		return $this
			-> belongsToMany(Modulo::class, "alumnomodulo", "modulo", "alumno")
			-> withPivot("alumno", "curso", "modulo");
	}

	public function profesor() {
		return $this -> belongsTo(Personal::class, "tutor", "id");
	}

	public function lineas() {
		return $this -> hasMany(LineaExpediente::class, "modulo", "id");
	}
}

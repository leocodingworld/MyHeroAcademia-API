<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	protected $table = "notas";
	protected $primaryKey = "referencia";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"idAlumno",
		"idCurso",
		"idModulo",
		"periodo",
		"calificacion",
		"observaciones"
	];

	protected $hidden = [
		"idAlumno",
		"idCurso",
		"idModulo",
	];

	public function curso() {
		return $this -> belongsTo(Curso::class, "idCurso", "id");
	}

	public function modulo() {
		return $this -> belongsTo(Modulo::class, "idModulo", "id");
	}
}

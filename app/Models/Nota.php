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
		"alumno",
		"ahno",
		"curso",
		"modulo",
		"periodo",
		"calificacion",
		"observaciones"
	];

	public function cursoInfo() {
		return $this -> belongsTo(Curso::class, "curso", "id");
	}

	public function moduloInfo() {
		return $this -> belongsTo(Modulo::class, "modulo", "id");
	}
}

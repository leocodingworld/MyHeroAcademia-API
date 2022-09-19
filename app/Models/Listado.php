<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listado extends Model
{
	protected $table = "listados";
	protected $primaryKey = "idModulo";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"idModulo",
		"idAlumno",
		"idCurso",
		"anho"
	];

	public function modulo() {

	}

	public function curso() {

	}

	public function alumno() {

	}
}

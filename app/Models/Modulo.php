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

	protected $hidden = [
		"horas"
	];

	public function curso() {
		return $this -> belongsTo(Curso::class, "idCurso", "id");
	}

	public function alumnos() {
		return $this -> hasMany(Listado::class, "idModulo", "id");
	}

	public function profesor() {
		return $this -> belongsTo(Personal::class, "tutor", "id");
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LineaExpediente;

class Expediente extends Model
{
	protected $table = "expedientes";
	protected $primaryKey = "numero";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"id",
		"idAlumno"
	];

	public function lineas() {
		// Clase, columnaForánea, ColumnaLocal
		return $this -> hasMany(LineaExpediente::class, "numExpediente", "numero");
	}

	public function alumno() {
		// Clase, columnaLocal, columnaForánea
		return $this -> belongsTo(Alumno::class, "idAlumno", "id");
	}
}

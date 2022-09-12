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

	protected $fillable = ["id", "alumno"];

	public function lineas() {
		// Clase, columnaForánea, ColumnaLocal
		return $this -> hasMany(LineaExpediente::class, "numExpediente", "numero");
	}

	public function alumnoId() {
		// Clase, columnaLocal, columnaForánea
		return $this -> belongsTo(Alumno::class, "alumno", "id");
	}
}

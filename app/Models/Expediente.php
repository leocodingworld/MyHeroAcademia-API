<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LineasExpediente;

class Expediente extends Model
{
	protected $table = "expedientes";
	protected $primaryKey = "numero";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = ["id", "alumno"];

	public function lineasExpediente() {
		// Clase, columnaForánea, ColumnaLocal
		return $this -> hasMany(LineasExpediente::class, "expediente", "numero");
	}

	public function alumnoId() {
		// Clase, columnaLocal, columnaForánea
		return $this -> belongsTo(Alumno::class, "alumno", "id");
	}
}


// $expediente = Expediente::find(16)

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaExpediente extends Model
{
    protected $table = "lineasExpedientes";
	protected $primaryKey = "linea";
	public $incrementing = true;
	public $timestamps = false;

	public function expediente() {
		return $this -> belongsTo(Expediente::class, "numExpediente", "numero");
	}

	protected $fillable = [
		"numExpediente",
		"linea",
		"anho",
		"idCurso",
		"modulo",
		"convocatoria",
		"calificacion",
		"observaciones"
	];
}

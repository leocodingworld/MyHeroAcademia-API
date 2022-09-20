<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineaExpediente extends Model
{
    protected $table = "lineasExpedientes";
	protected $primaryKey = "linea";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"numExpediente",
		"linea",
		"idCurso",
		"modulo",
		"convocatoria",
		"calificacion",
		"observaciones"
	];

	public function expediente() {
		return $this -> belongsTo(Expediente::class, "numExpediente", "numero");
	}
}

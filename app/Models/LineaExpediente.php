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

	public function moduloInfo() {
		return $this -> belongsTo(Modulo::class, "id", "modulo");
	}

	protected $fillable = [
		"numExpediente",
		"linea",
		"idCurso",
		"modulo",
		"periodo",
		"fecha",
		"calificacion",
		"observaciones"
	];
}

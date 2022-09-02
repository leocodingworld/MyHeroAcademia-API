<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineasExpediente extends Model
{
    protected $table = "lineasExpedientes";
	protected $primaryKey = ["expediente", "linea"];
	public $incrementing = false;
	public $timestamps = false;

	public function expediente() {
		return $this -> belongsTo(Expediente::class, "expediente", "expediente");
	}

	protected $fillable = [
		"expediente",
		"linea",
		"curso",
		"modulo",
		"periodo",
		"fecha",
		"calificacion",
		"observaciones"
	];
}

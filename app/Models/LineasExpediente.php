<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\PseudoTypes\True_;

class LineasExpediente extends Model
{
    protected $table = "lineasExpedientes";
	protected $primaryKey = "linea";
	public $incrementing = true;
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

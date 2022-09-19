<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	protected $table = "notas";
	protected $primaryKey = "referencia";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = [
		"alumno",
		"ahno",
		"curso",
		"modulo",
		"periodo",
		"calificacion",
		"observaciones"
	];


}

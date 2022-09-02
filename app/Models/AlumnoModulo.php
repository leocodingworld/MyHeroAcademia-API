<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Borrar?
class AlumnoModulo extends Model
{
	protected $table = "alumnoModulo";
	protected $primaryKey = "alumno";
	public $incrementing = false;
	public $timestamps = false;
}

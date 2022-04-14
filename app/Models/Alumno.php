<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Usuario;

class Alumno extends Model
{
    use HasFactory;

	protected $table = "alumnos";
	protected $primaryKey = "idAlumno";
	public $incrementing = false;
	public $timestamps = false;

	public function idAlumno() {
		return $this -> hasMany(Usuario::class, "idAlumno");
	}

	protected $filliable = [
		"fechaMatricula"
	];

	// protected $hidden = [
	// 	"idAlumno"
	// ];
}

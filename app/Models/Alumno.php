<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Usuario;

class Alumno extends Model
{
	protected $table = "alumnos";
	protected $primaryKey = "id";
	public $incrementing = false;
	public $timestamps = false;

	public function expediente() {
		return $this -> hasOne(Expediente::class, "expediente", "id");
	}

	 public function modulos() {
		return $this -> belongsToMany("");
	 }

	protected $filliable = [
		"id",
		"fechaMatricula"
	];
}

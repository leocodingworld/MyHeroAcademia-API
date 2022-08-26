<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Usuario;

class Alumno extends Model
{
    use HasFactory;

	protected $table = "alumnos";
	protected $primaryKey = "id";
	public $incrementing = false;
	public $timestamps = false;

	protected $filliable = [
		"id",
		"fechaMatricula"
	];

	protected $guarded = [
		"id"
	];
}

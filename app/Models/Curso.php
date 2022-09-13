<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

	protected $table = "cursos";
	protected $primaryKey = "id";
	public $incrementing = true;
	public $timestamps = false;

	public function modulos() {
		return $this -> hasMany(Modulo::class, "idCurso", "id");
	}

	public function profesor() {
		return $this -> belongsTo(Personal::class, "id", "tutor");
	}

	protected $fillable = [
		"nombre",
		"nombreCorto",
		"tipo",
		"tutor"
	];
}

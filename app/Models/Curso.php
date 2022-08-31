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

	protected $fillable = [
		"nombre",
		"nombreCorto",
		"tipo",
		"tutor"
	];
}

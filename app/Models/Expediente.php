<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{

	protected $table = "expedientes";
	protected $primaryKey = "numero";
	public $incrementing = true;
	public $timestamps = false;

	protected $fillable = ["id", "alumno"];
}

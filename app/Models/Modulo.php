<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

	protected $table = "modulos";
	protected $primaryKey = ["curso", "id"];
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		"nombre",
		"nombreCorto",
		"nivel",
		"profesor",
		"horas",
		"curso",
		"id"
	];
}

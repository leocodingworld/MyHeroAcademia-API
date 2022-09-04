<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("usuarios", function(Blueprint $table) {
			$table -> unsignedInteger("id", true);

			$table -> string("dni", 9) -> unique();
			$table -> string("nombre", 25);
			$table -> string("apellidos", 35);
			$table -> string("sexo", 6);

			$table -> string("direccion", 100);
			$table -> string("localidad", 40);
			$table -> string("municipio", 30);
			$table -> string("provincia", 30);
			$table -> string("codigoPostal", 5);
			$table -> string("telefono", 20);
			$table -> date("fechaNacimiento");
			$table -> string("email") -> unique();
			$table -> boolean("activo") -> default(true);
			$table -> tinyInteger("nivel", false, true);
			$table -> binary("password");
		});

		Schema::create("personal", function(Blueprint $table) {
			$table -> unsignedInteger("id");

			$table -> string("numSegSocial", 11);
			$table -> string("puesto");

			$table
				-> foreign("id")
				-> references("id")
				-> on("usuarios");
		});

		Schema::create("alumnos", function(Blueprint $table) {
			$table -> unsignedInteger("id");

			$table -> date("fechaMatricula");

			$table
				-> foreign("id")
				-> references("id")
				-> on("usuarios");
		});

		Schema::create("cursos", function(Blueprint $table) {
			$table -> unsignedInteger("id");

			$table -> string("nombre", 50);
			$table -> string("nombreCorto", 4);
			$table -> string("tipo", 35);
			$table -> string("nivel", 3);
			$table -> unsignedInteger("tutor") -> nullable();

			$table -> primary("id");

			$table
				-> foreign("tutor")
				-> references("id")
				-> on("personal");
		});

		Schema::create("modulos", function(Blueprint $table) {
			$table -> unsignedInteger("id");
			$table -> unsignedInteger("idCurso");

			$table -> string("nombre", 65);
			$table -> string("nombreCorto", 6);
			$table -> smallInteger("horas");
			$table -> unsignedInteger("tutor") -> nullable();

			$table -> primary(["id", "idCurso"], "pk_modulo_curso");

			$table
				-> foreign("idCurso")
				-> references("id")
				-> on("cursos");

			$table
				-> foreign("tutor")
				-> references("id")
				-> on("personal");
		});

		Schema::create("alumnoModulo", function(Blueprint $table) {
			$table -> unsignedInteger("curso");
			$table -> unsignedInteger("modulo");
			$table -> unsignedInteger("alumno");

			$table -> primary(["curso", "modulo", "alumno"]);

			$table
				-> foreign(["curso", "modulo"])
				-> references(["idCurso", "id"])
				-> on("modulos");

			$table
				-> foreign("alumno")
				-> references("id")
				-> on("alumnos");
		});

		Schema::create("expedientes", function(Blueprint $table) {
			$table -> unsignedInteger("numero", true);
			$table -> unsignedInteger("alumno");

			$table
				-> foreign("alumno")
				-> references("id")
				-> on("alumnos");
		});

		Schema::create("lineasExpedientes", function(Blueprint $table) {
			$table -> unsignedInteger("numExpediente");
			$table -> unsignedInteger("linea");
			$table -> unsignedInteger("idCurso");
			$table -> unsignedInteger("modulo");
			$table -> string("periodo", 40);
			$table -> date("fecha");
			$table -> tinyInteger("calificacion") -> nullable();
			$table -> text("observaciones") -> nullable();

			$table -> primary(["numExpediente", "linea"]);

			$table
				-> foreign("numExpediente")
				-> references("numero")
				-> on("expedientes");

			$table
				-> foreign(["idCurso", "modulo"])
				-> references(["idCurso", "id"])
				-> on("modulos");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists("lineasExpedientes");
		Schema::dropIfExists("expedientes");
		Schema::dropIfExists("alumnoModulo");
		Schema::dropIfExists("modulos");
		Schema::dropIfExists("cursos");
		Schema::dropIfExists("alumnos");
		Schema::dropIfExists("personal");
		Schema::dropIfExists("passwd");
		Schema::dropIfExists("usuarios");
    }
};

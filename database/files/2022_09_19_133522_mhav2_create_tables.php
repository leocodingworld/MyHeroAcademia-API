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
        Schema::create("datosUsuarios", function(Blueprint $table) {
			$table -> unsignedInteger("id", true);

			$table -> string("dni", 9) -> unique("dniUnique");
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
		});

		Schema::create("usuarios", function(Blueprint $table) {
			$table -> unsignedInteger("id", true);

			$table -> string("nombre") -> unique("nombreUnique");
			$table -> string("email") -> unique("emailUnique");
			$table -> string("nivel", 1);
			$table -> binary("password");
			$table -> rememberToken();
			$table -> boolean("activo") -> default(true);

			$table
				-> foreign("id")
				-> references("id")
				-> on("datosUsuarios");
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

			$table -> boolean("matriculado") -> default(true);
			$table -> date("anho") -> nullable();

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

		Schema::create("listados", function(Blueprint $table) {
			$table -> unsignedInteger("idCurso");
			$table -> unsignedInteger("idModulo");
			$table -> unsignedInteger("idAlumno");

			$table -> primary(["idCurso", "idModulo", "idAlumno"]);

			$table
				-> foreign(["idCurso", "idModulo"])
				-> references(["idCurso", "id"])
				-> on("modulos");

			$table
				-> foreign("idAlumno")
				-> references("id")
				-> on("alumnos");
		});

		Schema::create("notas", function(Blueprint $table) {
			$table -> unsignedInteger("referencia", true);

			$table -> unsignedInteger("alumno");
			$table -> string("anho", 9);
			$table -> unsignedInteger("curso");
			$table -> unsignedInteger("modulo");
			$table -> string("periodo");
			$table -> unsignedTinyInteger("calificacion");
			$table -> text("observaciones") -> nullable();

			$table
				-> foreign("alumno", "fk_alumno")
				-> references("id")
				-> on("alumnos");

			$table
				-> foreign("curso", "fk_curso")
				-> references("id")
				-> on("cursos");

			$table
				-> foreign("modulo", "fk_modulo")
				-> references("id")
				-> on("modulos");
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
			$table -> string("anho", 9);
			$table -> unsignedInteger("idCurso");
			$table -> unsignedInteger("idModulo");
			$table -> string("convocatoria", 14);
			$table -> tinyInteger("calificacion") -> nullable();
			$table -> text("observaciones") -> nullable();

			$table -> primary(["numExpediente", "linea"]);

			$table
				-> foreign("numExpediente")
				-> references("numero")
				-> on("expedientes");

			$table
				-> foreign(["idCurso", "idModulo"])
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
        //
    }
};

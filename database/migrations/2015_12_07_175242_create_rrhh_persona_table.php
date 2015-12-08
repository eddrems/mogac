<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRrhhPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrhh_persona', function (Blueprint $table) {
            $table->bigIncrements('id_persona');
            $table->bigInteger('id_persona_estado')->unsigned();
            $table->bigInteger('id_genero');
            $table->string('id_tipo_identificacion', 1);
            $table->string('identificacion', 30)->nullable();
            $table->string('apellidos', 250);
            $table->string('nombres', 250);
            $table->string('correo', 250);
            $table->string('clave_acceso', 500);
            $table->string('remember_token', 255)->nullable();
            $table->tinyInteger('requiere_cambio_clave');
            $table->tinyInteger('requiere_actualizar_datos_funcionario');
            $table->tinyInteger('requiere_actualizar_datos_ciudadano');
            $table->bigInteger('id_funcionario_migrado')->unsigned()->nullable();
            $table->bigInteger('id_usuario_migrado')->unsigned()->nullable();

            $table->foreign('id_genero')->references('id_genero')->on('rrhh_genero');
            $table->foreign('id_persona_estado')->references('id_persona_estado')->on('rrhh_persona_estado');

            $table->unique('identificacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rrhh_persona');
    }
}

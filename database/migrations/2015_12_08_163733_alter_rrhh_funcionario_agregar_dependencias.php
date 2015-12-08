<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRrhhFuncionarioAgregarDependencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `rrhh_funcionario` MODIFY `id_persona` BIGINT UNSIGNED NOT NULL;');
        Schema::table('rrhh_funcionario', function (Blueprint $table) {
            $table->dropForeign('rrhh_funcionario_ibfk_1');
            $table->dropForeign('rrhh_funcionario_ibfk_2');
            $table->dropForeign('rrhh_funcionario_ibfk_4');
            $table->dropForeign('rrhh_funcionario_ibfk_6');


            $table->dropIndex('identificacion');
            $table->dropIndex('FK_tipo_identificacion');
            $table->dropIndex('FK_rrhh_funcionario_rrhh_genero');
            $table->dropIndex('FK_rrhh_funcionario_rrhh_estado_civil');
            $table->dropIndex('id_funcionario_estado');
            $table->dropColumn('id_funcionario_estado');
            $table->dropColumn('id_tipo_identificacion');
            $table->dropColumn('id_genero');
            $table->dropColumn('id_estado_civil');

            $table->dropColumn('identificacion');
            $table->dropColumn('apellidos');
            $table->dropColumn('nombres');
            $table->dropColumn('correo');
            $table->dropColumn('usuario');
            $table->dropColumn('clave_acceso');
            $table->dropColumn('remember_token');
            $table->dropColumn('requiere_cambio_clave');
            $table->dropColumn('requiere_actualizar_datos_contacto');

            $table->foreign('id_persona')->references('id_persona')->on('rrhh_persona');

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
}

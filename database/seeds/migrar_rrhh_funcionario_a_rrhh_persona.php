<?php

use Illuminate\Database\Seeder;

class migrar_rrhh_funcionario_a_rrhh_persona extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $funcionarios_a_migrar =DB::table('rrhh_funcionario')
            ->whereNull('migrado')
            ->orderBy('id_funcionario')
            ->select(
                'id_funcionario',
                'id_funcionario_estado',
                'id_tipo_identificacion',
                'id_genero',
                'identificacion',
                'apellidos',
                'nombres',
                'correo',
                'usuario',
                'clave_acceso',
                'requiere_cambio_clave',
                'requiere_actualizar_datos_contacto'
            )->take(2000)
            ->get();


        foreach($funcionarios_a_migrar as $funcionario)
        {
            $requiere_cambio_clave = ($funcionario->requiere_cambio_clave != null ? $funcionario->requiere_cambio_clave : 0);
            $requiere_actualizar_datos_funcionario = ($funcionario->requiere_actualizar_datos_contacto != null ? $funcionario->requiere_actualizar_datos_contacto : 0);


            DB::table('rrhh_persona')->insert([
                'id_persona_estado' => $funcionario->id_funcionario_estado,
                'id_genero' => $funcionario->id_genero,
                'id_tipo_identificacion' => $funcionario->id_tipo_identificacion,
                'identificacion' => $funcionario->identificacion,
                'apellidos' => $funcionario->apellidos,
                'nombres' => $funcionario->nombres,
                'correo' => $funcionario->correo,
                'clave_acceso' => $funcionario->clave_acceso,
                'requiere_cambio_clave' => $requiere_cambio_clave,
                'requiere_actualizar_datos_funcionario' => $requiere_actualizar_datos_funcionario,
                'requiere_actualizar_datos_ciudadano' => 0,
                'id_funcionario_migrado' => $funcionario->id_funcionario
            ]);

            $id_persona = DB::table('rrhh_persona')->where('id_funcionario_migrado', $funcionario->id_funcionario)->max('id_persona');

            DB::table('rrhh_funcionario')
                ->where('id_funcionario', $funcionario->id_funcionario)
                ->update(['migrado' => 1, 'id_persona' => $id_persona]);

        }



    }
}

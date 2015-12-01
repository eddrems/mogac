<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhCargo extends Model {


    protected $table = 'rrhh_cargo';
    protected $primaryKey = 'id_cargo';
    protected $fillable =  ['denominacion', 'aplicable_personas', 'aplicable_funcionarios', 'aplicable_nacional', 'aplicable_zonal', 'aplicable_distrito', 'valida_traslados_tramite_distritos', 'id_rol_predeterminado'];
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_cargo');
    }


}

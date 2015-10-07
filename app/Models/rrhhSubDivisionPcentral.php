<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhSubDivisionpcentral extends Model {


    protected $table = 'pcentral_subdivision';
    protected $primaryKey = 'id_subdivision_pcentral';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionariopcentral', 'id_subdivision_pcentral');
    }

    public function pcdepartamento()
    {
        return $this->hasMany('App\Models\rrhhDepartamentoPcentral', 'id_departamento_pcentral');
    }

}
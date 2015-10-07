<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhDepartamentoPcentral extends Model {


    protected $table = 'pcentral_departamento';
    protected $primaryKey = 'id_departamento_pcentral';
    public $timestamps = false;


    public function SubDivision()
    {
        return $this->hasMany('App\Models\pcentral_subdivision', 'id_departamento_pcentral');
    }

}

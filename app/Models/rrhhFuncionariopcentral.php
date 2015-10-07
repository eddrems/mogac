<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhFuncionariopcentral extends Model {

    protected $table = 'pcentral_funcionario';
    protected $primaryKey = 'id_funcionario_pcentral';
    public $timestamps = false;


    public function getdepartamentoAttribute()
    {
        return rrhhSubDivisionpcentral::find($this->attributes['id_subdivision_pcentral'])->denominacion;
    }



    public function cargo()
    {
        return $this->belongsTo('App\Models\rrhhFuncionarioCargopcentral', 'id_cargo_pcentral');
    }

    public function Subdivision()
    {
        return $this->belongsTo('App\Models\rrhhSubDivisionPcentral', 'id_subdivision_pcentral');
    }





}






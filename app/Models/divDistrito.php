<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divDistrito extends Model {


    protected $table = 'div_distrito';
    protected $primaryKey = 'id_distrito';
    protected $fillable = ['id_zona','codigoSemplades','denominacion','denominacion_institucional','composicion','id_parroquia','id_circuito','direccion','saltar_numeracion'];
    public $timestamps = false;


    public function getciudadAttribute()
    {
        $parroquia = divParroquia::find($this->attributes['id_parroquia']);
        return divCiudad::find($parroquia->id_ciudad)->denominacion;
    }




    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_distrito');
    }
    public function zona()
    {
        return $this->belongsTo('App\Models\divZona', 'id_zona');
    }
    public function parroquia()
    {
        return $this->belongsTo('App\Models\divParroquia', 'id_parroquia');
    }

}




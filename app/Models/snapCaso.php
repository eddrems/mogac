<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class snapCaso extends Model {

    protected $table = 'snap_caso';
    protected $primaryKey = 'id_caso';
    public $timestamps = false;


    public function getservicioAttribute()
    {
        return snapServicio::find($this->attributes['id_servicio'])->denominacion;
    }


    public function servicio()
    {
        return $this->belongsTo('App\Models\snapServicio', 'id_servicio');
    }


}


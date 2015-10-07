<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configRecuperacionClaveToken extends Model  {

    protected $table = 'config_recuperacion_clave_token';
    protected $primaryKey = 'id_recuperacion_clave_token';
    public $timestamps = false;



    function generarToken($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }


    

    //dependencias
    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario');
    }


}






<?php namespace App\Http\Requests\Catalogos;

use App\Http\Requests\Request;

class div_zonaRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'codigoSemplades' => 'required',
            'denominacion' => 'required',
            'denominacion_institucional' => 'required',
            'composicion' => 'required',
            'logo_certificacion' => 'required',
            'numero_certificacion' => 'required',
            'pie_pagina_certificacion' => 'required',
            'logo_top' => 'required',
            'logo_left' => 'required',
            'numero_top' => 'required',
            'numero_width' => 'required',
            'logo_scale' => 'required'
        ];
    }


}

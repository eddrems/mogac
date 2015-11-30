<?php namespace App\Http\Requests\Catalogos;

use App\Http\Requests\Request;

class aciud_estado_tramiteRequest extends Request {

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
            'orden' => 'required',
            'denominacion' => 'required',
            'css_color' => 'required',
            'css_label_class' => 'required',
            'letra' => 'required',
            'permite_edicion' => 'required',
            'proceso_terminado' => 'required',
            'permite_cambio_manual' => 'required',
            'permite_traslado_distrito' => 'required'
        ];
    }


}

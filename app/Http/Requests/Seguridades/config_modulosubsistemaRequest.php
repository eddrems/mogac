<?php namespace App\Http\Requests\Seguridades;

use App\Http\Requests\Request;

class config_modulosubsistemaRequest extends Request {

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
            'descripcion' => 'required',
            'esta_activo' => 'required',
            'orden' => 'required|numeric',
            'icon' => 'required'
        ];
    }


}

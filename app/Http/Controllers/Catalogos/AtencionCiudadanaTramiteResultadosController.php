<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\aciudTramiteResultadoRepository as repoResultados;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class AtencionCiudadanaTramiteResultadosController extends Controller {


    private $repo_main;

    public function __construct(repoResultados $repo_main) {

        $this->repo_main = $repo_main;
    }



    public function index()
    {
        return view('catalogos.ac_tramite_resultados.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('requiere_observaciones',function($model)
            {
                if ($model->requiere_observaciones == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/tramites_resultado/editar') .'/'. Crypt::encrypt($model->id_tramite_resultado) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/tramites_resultado/eliminar') .'/'. Crypt::encrypt($model->id_tramite_resultado) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'id_tramite_resultado',
                'denominacion'
            )
            ->orderColumns(
                'id_tramite_resultado',
                'denominacion'
            )
            ->make();
    }


    public function crear()
    {


        return view('catalogos.ac_tramite_resultados.crear');
    }

    public function grabar_nuevo(Requests\Catalogos\aciud_tramite_resultadoRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/tramites_resultado');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/tramites_resultado/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));


        return view('catalogos.ac_tramite_resultados.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\aciud_tramite_resultadoRequest  $request)
    {
        if($this->repo_main->update($request->only(['denominacion', 'requiere_observaciones']), Crypt::decrypt($request->id), 'id_tramite_resultado'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/tramites_resultado/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/tramites_resultado/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.ac_tramite_resultados.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/tramites_resultado');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/tramites_resultado/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








<?php namespace App\Http\Controllers\Catalogos;

use App\Repositories\aciudProcesoRepository as repoProcesos;
use App\Repositories\aciudProcesoRequisitosRepository as repoRequerisitos;
use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class AtencionCiudadanaProcesosReuqerimientosController extends Controller {


    private $repo_procesos;
    private $repo_main;

    public function __construct(repoProcesos $repo_procesos, repoRequerisitos $repo_main) {

        $this->repo_procesos = $repo_procesos;
        $this->repo_main = $repo_main;
    }



    public function listar($id_proceso)
    {
        $proceso = $this->repo_procesos->find(Crypt::decrypt($id_proceso));

        return view('catalogos.ac_procesos_requisitos.index', ['proceso' => $proceso]);
    }

    public function buscar_registros_dt($id_proceso)
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt(Crypt::decrypt($id_proceso)))
            ->addColumn('nombre',function($model)
            {
                return $model->nombre;
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/procesos_ac/requisitos/editar') .'/'. Crypt::encrypt($model->id_requisitos) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/procesos_ac/requisitos/eliminar') .'/'. Crypt::encrypt($model->id_requisitos) .'" class="btn btn-danger btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '</div>';
            })
            ->searchColumns(
                'id_proceso',
                'nombre',
                'observaciones'
            )
            ->orderColumns(
                'id_proceso',
                'nombre',
                'observaciones'
            )
            ->make();
    }


    public function crear($id_proceso)
    {
        $proceso = $this->repo_procesos->find(Crypt::decrypt($id_proceso));

        return view('catalogos.ac_procesos_requisitos.crear', ['proceso' => $proceso]);
    }

    public function grabar_nuevo(Requests\Catalogos\aciud_proceso_requisitosRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/procesos_ac/requisitos/listar/' . Crypt::encrypt($request->id_proceso));
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/procesos_ac/requisitos/crear/' . Crypt::encrypt($request->id_proceso))->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $proceso = $this->repo_procesos->find($registro->id_proceso);

        return view('catalogos.ac_procesos_requisitos.editar', ['proceso' => $proceso])->with('reqistroe', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\aciud_proceso_requisitosRequest  $request)
    {
        if($this->repo_main->update($request->only(['nombre', 'observaciones']), Crypt::decrypt($request->id), 'id_requisitos'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/procesos_ac/requisitos/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/procesos_ac/requisitos/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $proceso = $this->repo_procesos->find($registro->id_proceso);

        return view('catalogos.ac_procesos_requisitos.eliminar', ['proceso' => $proceso])->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/procesos_ac/requisitos/listar/' . $request->id_proceso);
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/procesos_ac/requisitos/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








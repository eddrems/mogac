<?php namespace App\Http\Controllers\Catalogos;


use App\Models\divProvincia;
use App\Repositories\rrhhCargoRepository as repoCargos;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class PersonalCargoController extends Controller {


    private $repo_main;

    public function __construct(repoCargos $repo_main) {

        $this->repo_main = $repo_main;
    }



    public function index()
    {
        return view('catalogos.rrhh_cargos.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('aplicable_personas',function($model)
            {
                if ($model->aplicable_personas == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('aplicable_funcionarios',function($model)
            {
                if ($model->aplicable_funcionarios == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('aplicable_nacional',function($model)
            {
                if ($model->aplicable_nacional == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('aplicable_zonal',function($model)
            {
                if ($model->aplicable_zonal == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('aplicable_distrito',function($model)
            {
                if ($model->aplicable_distrito == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('valida_traslados_tramite_distritos',function($model)
            {
                if ($model->valida_traslados_tramite_distritos == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/cargos_funcionarios/editar') .'/'. Crypt::encrypt($model->id_cargo) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/cargos_funcionarios/eliminar') .'/'. Crypt::encrypt($model->id_cargo) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '</div>';
            })
            ->searchColumns(
                'denominacion'
            )
            ->orderColumns(
                'denominacion'
            )
            ->make();
    }


    public function crear()
    {
        return view('catalogos.rrhh_cargos.crear');
    }

    public function grabar_nuevo(Requests\Catalogos\rrhh_cargoRequest $request)
    {
        $last_id = divProvincia::max('id_provincia');
        $last_id++;

        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/cargos_funcionarios');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/cargos_funcionarios/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.rrhh_cargos.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\rrhh_cargoRequest  $request)
    {
        if($this->repo_main->update($request->only(['denominacion', 'aplicable_personas', 'aplicable_funcionarios', 'aplicable_nacional', 'aplicable_zonal', 'aplicable_distrito', 'valida_traslados_tramite_distritos']), Crypt::decrypt($request->id), 'id_cargo'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/cargos_funcionarios/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/cargos_funcionarios/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.rrhh_cargos.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/cargos_funcionarios');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/cargos_funcionarios/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








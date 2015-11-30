<?php namespace App\Http\Controllers\Seguridades;


use App\Repositories\configRolRepository as repoRoles;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class RolesController extends Controller {


    private $repo_main;

    public function __construct(repoRoles $repo_main) {

        $this->repo_main = $repo_main;
    }



    public function index()
    {
        return view('seguridades.roles.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('descripcion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('esta_vigente',function($model)
            {
                if ($model->esta_vigente == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('nivel_nacional',function($model)
            {
                if ($model->nivel_nacional == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('nivel_zonal',function($model)
            {
                if ($model->nivel_zonal == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('nivel_distrital',function($model)
            {
                if ($model->nivel_distrital == 1)
                    return '<i class="fa fa-check-square-o"></i>';
                else
                    return '<i class="fa fa-square-o"></i>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('seguridades/roles/editar') .'/'. Crypt::encrypt($model->id_rol) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('seguridades/roles/eliminar') .'/'. Crypt::encrypt($model->id_rol) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '<a href="' . url('seguridades/roles/permisos/listar') .'/'. Crypt::encrypt($model->id_rol) .'" class="btn btn-primary btn-xs btn-mini"><i class="fa fa-bars"></i> permisos</a>'
                . '</div>';
            })
            ->searchColumns(
                'denominacion',
                'denominacion_visual',
                'esta_vigente',
                'nivel_nacional',
                'nivel_zonal',
                'nivel_distrital'
            )
            ->orderColumns(
                    'denominacion',
                'denominacion_visual',
                'esta_vigente',
                'nivel_nacional',
                'nivel_zonal',
                'nivel_distrital'
            )
            ->make();
    }


    public function crear()
    {


        return view('seguridades.roles.crear');
    }

    public function grabar_nuevo(Requests\Seguridades\config_rolRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/roles');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('seguridades/roles/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));


        return view('seguridades.roles.editar')->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Seguridades\config_rolRequest  $request)
    {
        if($this->repo_main->update($request->only(['denominacion', 'denominacion_visual', 'esta_vigente', 'nivel_nacional', 'nivel_zonal', 'nivel_distrital']), Crypt::decrypt($request->id), 'id_rol'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/roles/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('seguridades/roles/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('seguridades.roles.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/roles');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('seguridades/roles/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








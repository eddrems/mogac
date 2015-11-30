<?php namespace App\Http\Controllers\Seguridades;


use App\Repositories\configRolRepository as repoRoles;
use App\Repositories\configRolModuloRepository as repoPermisos;
use App\Repositories\configModuloRepository as repoModulos;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class RolesPermisosController extends Controller {


    private $repo_main;
    private $repo_roles;
    private $repo_modulos;

    public function __construct(repoPermisos $repo_main, repoRoles $repo_roles, repoModulos $repo_modulos) {

        $this->repo_main = $repo_main;
        $this->repo_roles = $repo_roles;
        $this->repo_modulos = $repo_modulos;


    }



    public function listar($id_rol)
    {
        $rol = $this->repo_roles->find(Crypt::decrypt($id_rol));
        return view('seguridades.roles_permisos.index', ['rol' => $rol]);
    }

    public function buscar_registros_dt($id_rol)
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt(Crypt::decrypt($id_rol)))
            ->addColumn('modulo',function($model)
            {
                return $model->modulo;
            })
            ->addColumn('agrupador',function($model)
            {
                return '<small class="text-muted text-xs">' . $model->agrupador . '</small>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('seguridades/roles/permisos/eliminar') .'/'. Crypt::encrypt($model->id_rol_modulo) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '</div>';
            })
            ->searchColumns(
                'config_rol_modulo.id_rol_modulo',
                'config_modulo.descripcion',
                'config_modulosubsistema.descripcion'
            )
            ->orderColumns(
                'config_rol_modulo.id_rol_modulo',
                'config_modulo.descripcion',
                'config_modulosubsistema.descripcion'
            )
            ->make();
    }


    public function crear($id_rol)
    {
        $rol = $this->repo_roles->find(Crypt::decrypt($id_rol));
        $modulos = $this->repo_modulos->generar_lista_con_agrupador_permisos(null, Crypt::decrypt($id_rol));
        return view('seguridades.roles_permisos.crear', ['rol' => $rol, 'modulos' => $modulos]);
    }

    public function grabar_nuevo(Requests\Seguridades\config_rol_moduloRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/roles/permisos/listar/' .  Crypt::encrypt($request->id_rol));
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('seguridades/roles/permisos/crear/' .  Crypt::encrypt($request->id_rol))->withInput();
        }
    }



    public function eliminar($id)
    {
        $registro = $this->repo_main->with('modulo')->find(Crypt::decrypt($id));
        $rol = $this->repo_roles->find($registro->id_rol);

        return view('seguridades.roles_permisos.eliminar', ['rol' => $rol])->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/roles/permisos/listar/' .  Crypt::encrypt($request->id_rol));
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('seguridades/roles/permisos/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








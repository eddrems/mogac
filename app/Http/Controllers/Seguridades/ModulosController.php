<?php namespace App\Http\Controllers\Seguridades;


use App\Repositories\configModuloRepository as repoModulo;
use App\Repositories\configModuloSubsistemaRepository as repoModuloSub;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class ModulosController extends Controller {


    private $repo_main;
    private $repo_sub;

    public function __construct(repoModuloSub $repo_sub, repoModulo $repo_main) {

        $this->repo_main = $repo_main;
        $this->repo_sub = $repo_sub;
    }



    public function listar($id_subsistema)
    {
        $agrupador = $this->repo_sub->find(Crypt::decrypt($id_subsistema));

        return view('seguridades.modulos.index', ['agrupador' => $agrupador]);
    }

    public function buscar_registros_dt($id_subsistema)
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt(Crypt::decrypt($id_subsistema)))
            ->addColumn('descripcion',function($model)
            {
                return $model->descripcion . ' <small class="text-muted">(' . $model->texto . ')</small>';
            })
            ->addColumn('esta_activo',function($model)
            {
                return '[' . $model->controlador . ']' . '[' . $model->accion . ']';
            })
            ->addColumn('icon',function($model)
            {
                return '<i class="' . $model->icon . '"></i>';
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('seguridades/modulos/detalles/editar') .'/'. Crypt::encrypt($model->id_modulo) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('seguridades/modulos/detalles/eliminar') .'/'. Crypt::encrypt($model->id_modulo) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '</div>';
            })
            ->searchColumns(
                'id_modulo',
                'id_subsistema',
                'orden',
                'descripcion',
                'texto',
                'accion',
                'controlador',
                'icon'
            )
            ->orderColumns(
                'id_modulo',
                'id_subsistema',
                'orden',
                'descripcion',
                'texto',
                'accion',
                'controlador',
                'icon'
            )
            ->make();
    }


    public function crear($id_subsistema)
    {

        $agrupador = $this->repo_sub->find(Crypt::decrypt($id_subsistema));
        return view('seguridades.modulos.crear', ['agrupador' => $agrupador]);
    }

    public function grabar_nuevo(Requests\Seguridades\config_moduloRequest $request)
    {
        if($this->repo_main->create($request->all()))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/modulos/detalles/listar/' . Crypt::encrypt($request->id_subsistema));
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('seguridades/modulos/detalles/crear/' . Crypt::encrypt($request->id_subsistema))->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $agrupador = $this->repo_sub->find($registro->id_subsistema);

        return view('seguridades.modulos.edit', ['agrupador' => $agrupador])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Seguridades\config_moduloRequest  $request)
    {
        if($this->repo_main->update($request->only(['orden', 'descripcion', 'texto', 'accion', 'controlador', 'icon']), Crypt::decrypt($request->id), 'id_modulo'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/modulos/detalles/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('seguridades/modulos/detalles/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $agrupador = $this->repo_sub->find($registro->id_subsistema);

        return view('seguridades.modulos.eliminar', ['agrupador' => $agrupador])->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('seguridades/modulos/detalles/listar/' . $request->id_subsistema);
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('seguridades/modulos/detalles/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








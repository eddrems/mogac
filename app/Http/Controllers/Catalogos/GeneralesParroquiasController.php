<?php namespace App\Http\Controllers\Catalogos;


use App\Models\divCiudad;
use App\Models\divParroquia;
use App\Repositories\divParroquiaRepository as repoParroquias;
use App\Repositories\divCiudadRepository as repoCiudadas;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;

use App\Http\Requests;



use Toastr;
use Crypt;


use Illuminate\Http\Request;




class GeneralesParroquiasController extends Controller {


    private $repo_main;
    private $repo_ciudades;

    public function __construct(repoParroquias $repo_main,repoCiudadas $repo_ciudades) {

        $this->repo_main = $repo_main;
        $this->repo_ciudades = $repo_ciudades;
    }



    public function index($id_ciudad)
    {
        $ciudad = $this->repo_ciudades->with('provincia')->find(Crypt::decrypt($id_ciudad));
        
        return view('catalogos.lg_parroquias.index', ['ciudad' => $ciudad]);
    }

    public function buscar_registros_dt($id_ciudad)
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt($id_ciudad))
            ->addColumn('denominacion',function($model)
            {
                return $model->denominacion;
            })
            ->addColumn('codigo',function($model)
            {
                return $model->codigo;
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/parroquias/editar') .'/'. Crypt::encrypt($model->id_parroquia) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/parroquias/eliminar') .'/'. Crypt::encrypt($model->id_parroquia) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>'
                . '</div>';
            })
            ->searchColumns(
                'denominacion',
                'codigo'
            )
            ->orderColumns(
                'denominacion',
                'codigo'
            )
            ->make();
    }


    public function crear($id_ciudad)
    {
        $ciudad = $this->repo_ciudades->find(Crypt::decrypt($id_ciudad));

        return view('catalogos.lg_parroquias.crear', ['ciudad' => $ciudad]);
    }

    public function grabar_nuevo(Requests\Catalogos\div_parroquiaRequest $request)
    {
        $last_id = divParroquia::max('id_parroquia');
        $last_id++;

            if($this->repo_main->create(['id_parroquia' => $last_id, 'id_ciudad' => $request->id_ciudad, 'denominacion' => $request->denominacion, 'codigo' => $request->codigo]))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/parroquias/listar/' . Crypt::encrypt($request->id_ciudad));
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/parroquias/crear/' . Crypt::encrypt($request->id_ciudad))->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $ciudad = $this->repo_ciudades->find($registro->id_ciudad);


        return view('catalogos.lg_parroquias.editar', ['ciudad' => $ciudad])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\div_parroquiaRequest  $request)
    {
        if($this->repo_main->update($request->only(['denominacion', 'codigo']), Crypt::decrypt($request->id), 'id_parroquia'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/parroquias/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/parroquias/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $ciudad = $this->repo_ciudades->find($registro->id_ciudad);


        return view('catalogos.lg_parroquias.eliminar', ['ciudad' => $ciudad])->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/parroquias/listar'.'/'.$request->id_ciudad);
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/parroquias/'.'/'.$request->id)->withInput();
        }
    }







}








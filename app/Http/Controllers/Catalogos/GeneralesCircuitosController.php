<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\divDistritoRepository as repoDistritos;;
use App\Repositories\divCircuitoRepository as repoCircuitos;

use App\Http\Requests\Catalogos;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Repositories\CriteriosConsulta\Generales\ZonasOrdenAsc;

use Toastr;
use Crypt;


use Illuminate\Http\Request;




class GeneralesCircuitosController extends Controller {


    private $repo_main;
    private $repo_distritos;

    public function __construct(repoDistritos $repo_distritos, repoCircuitos $repo_main) {

        $this->repo_main = $repo_main;
        $this->repo_distritos = $repo_distritos;
    }



    public function index()
    {
        return view('catalogos.gen_circuitos.index');
    }

    public function buscar_registros_dt()
    {

        return \Datatable::query($this->repo_main->buscar_todos_dt())
            ->addColumn('codigoSemplades',function($model)
            {
                return $model->codigoSemplades;
            })
            ->addColumn('zona',function($model)
            {
                return $model->zona;
            })
            ->addColumn('distrito',function($model)
            {
                return $model->distrito;
            })
            ->addColumn('composicion',function($model)
            {
                return $model->composicion;
            })
            ->addColumn('commands',function($model)
            {
                return  '<div class="btn-group">'
                . '<a href="' . url('catalogos/circuitos/editar') .'/'. Crypt::encrypt($model->id_circuito) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/circuitos/eliminar') .'/'. Crypt::encrypt($model->id_circuito) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'div_circuito.id_circuito',
                'div_circuito.id_distrito',
                'div_circuito.codigoSemplades',
                'div_circuito.composicion',
                'div_distrito.denominacion',
                'div_zona.denominacion'
            )
            ->orderColumns(
                'div_circuito.id_circuito',
                'div_circuito.id_distrito',
                'div_circuito.codigoSemplades',
                'div_circuito.composicion',
                'div_distrito.denominacion',
                'div_zona.denominacion'
            )
            ->make();
    }


    public function crear()
    {
        $distritos = $this->repo_distritos->buscar_distritos_con_zona_lists();

        return view('catalogos.gen_circuitos.crear', ['distritos' => $distritos]);
    }

    public function grabar_nuevo(Requests\Catalogos\div_circuitoRequest $request)
    {

        if($this->repo_main->create($request->only(['id_distrito', 'codigoSemplades', 'composicion'])))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/circuitos');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/circuitos/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $distritos = $this->repo_distritos->buscar_distritos_con_zona_lists();

        return view('catalogos.gen_circuitos.editar', ['distritos' => $distritos])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\div_circuitoRequest  $request)
    {
        if($this->repo_main->update($request->only(['id_distrito', 'codigoSemplades', 'composicion']), Crypt::decrypt($request->id), 'id_circuito'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/circuitos/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/circuitos/editar'.'/'.$request->id)->withInput();
        }
    }


    public function eliminar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));

        return view('catalogos.gen_circuitos.eliminar')->with('registro', $registro);
    }

    public function grabar_eliminar(Request $request)
    {
        try {
            $this->repo_main->delete(Crypt::decrypt($request->id));

            Toastr::success($this->repo_main->mensajes_eliminacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/circuitos');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/circuitos/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








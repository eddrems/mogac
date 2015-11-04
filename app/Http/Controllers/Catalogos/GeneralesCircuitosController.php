<?php namespace App\Http\Controllers\Catalogos;


use App\Repositories\divDistritoRepository as repoDistritos;
use App\Repositories\divZonaRepository as repoZonas;
use App\Repositories\divParroquiaRepository as repoParroquias;
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
    private $repo_zonas;
    private $repo_parroquias;
    private $repo_distritos;

    public function __construct(repoDistritos $repo_distritos, repoZonas $repo_zonas, repoParroquias $repo_parroquias, repoCircuitos $repo_main) {

        $this->repo_main = $repo_main;
        $this->repo_zonas = $repo_zonas;
        $this->repo_parroquias = $repo_parroquias;
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
                . '<a href="' . url('catalogos/distritos/editar') .'/'. Crypt::encrypt($model->id_circuito) .'" class="btn btn-default btn-xs btn-mini "><i class="fa fa-pencil"></i></a>'
                . '<a href="' . url('catalogos/distritos/eliminar') .'/'. Crypt::encrypt($model->id_circuito) .'" class="btn btn-dark btn-xs btn-mini"><i class="fa fa-trash-o"></i></a>&nbsp;'
                . '</div>';
            })
            ->searchColumns(
                'div_circuito.id_circuito',
                'div_circuito.id_distrito',
                'div_circuito.codigoSemplades',
                'div_distrito.composicion',
                'div_distrito.denominacion',
                'div_zona.denominacion'
            )
            ->orderColumns(
                'div_circuito.id_circuito',
                'div_circuito.id_distrito',
                'div_circuito.codigoSemplades',
                'div_distrito.composicion',
                'div_distrito.denominacion',
                'div_zona.denominacion'
            )
            ->make();
    }


    public function crear()
    {
        $parroquias = $this->repo_parroquias->bucar_parroquias_ruta_completa();
        $circuitos = $this->repo_circuitos->bucar_cicuitos_por_distrito_lists(0);
        $zonas = $this->repo_zonas->pushCriteria(new ZonasOrdenAsc())->lists('denominacion_institucional', 'id_zona');

        return view('catalogos.gen_circuitos.crear', ['parroquias' => $parroquias, 'circuitos' => $circuitos, 'zonas' => $zonas]);
    }

    public function grabar_nuevo(Requests\Catalogos\div_distritoRequest $request)
    {

        if($this->repo_main->create($request->only(['id_zona', 'codigoSemplades', 'denominacion', 'denominacion_institucional', 'composicion', 'id_parroquia', 'direccion'])))
        {
            Toastr::success($this->repo_main->mensajes_ingreso, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/distritos');
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/distritos/crear')->withInput();
        }
    }


    public function editar($id)
    {
        $registro = $this->repo_main->find(Crypt::decrypt($id));
        $parroquias = $this->repo_parroquias->bucar_parroquias_ruta_completa();
        $circuitos = $this->repo_circuitos->bucar_cicuitos_por_distrito_lists($registro->id_distrito);
        $zonas = $this->repo_zonas->pushCriteria(new ZonasOrdenAsc())->lists('denominacion_institucional', 'id_zona');


        return view('catalogos.gen_circuitos.editar', ['parroquias' => $parroquias, 'circuitos' => $circuitos, 'zonas' => $zonas])->with('registro', $registro);
    }

    public function grabar_actualizar(Requests\Catalogos\div_distritoRequest  $request)
    {
        if($this->repo_main->update($request->only(['id_zona', 'codigoSemplades', 'denominacion', 'denominacion_institucional', 'composicion', 'id_parroquia', 'id_circuito', 'direccion']), Crypt::decrypt($request->id), 'id_distrito'))
        {
            Toastr::success($this->repo_main->mensajes_actualizacion, $title = 'Confirmación:', $options = []);
            return redirect('catalogos/distritos/editar'.'/'.$request->id);
        }
        else
        {
            Toastr::error('Ha ocurrido un error', $title = 'Error:', $options = []);
            return redirect('catalogos/distritos/editar'.'/'.$request->id)->withInput();
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
            return redirect('catalogos/distritos');
        }
        catch(\Exception $e) {
            Toastr::error($e->getMessage(), $title = 'Error:', $options = []);
            return redirect('catalogos/distritos/eliminar'.'/'.$request->id)->withInput();
        }
    }







}








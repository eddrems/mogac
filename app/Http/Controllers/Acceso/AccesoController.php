<?php namespace App\Http\Controllers\Acceso;

use App\Repositories\rrhhFuncionarioRepository as repoFuncionarios;
use App\Repositories\configLogSesionRepository as repoLogsSesion;
use App\Repositories\rrhhEstadoCivilRepository as repoEstadosCiviles;
use App\Repositories\rrhhFuncionarioGeneroRepository as reporGeneros;




use App\Models\rrhhFuncionario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Auth;
use Toastr;
use Session;
use Crypt;
use Hash;

class AccesoController extends Controller {


    private $repo_persona;
    private $repo_logs;
    private $repo_estados_civiles;
    private $repo_generos;

    public function __construct(repoFuncionarios $repo_persona, repoLogsSesion $repo_logs, repoEstadosCiviles $repo_estados_civiles, reporGeneros $repo_generos) {

        $this->repo_persona = $repo_persona;
        $this->repo_logs = $repo_logs;
        $this->repo_estados_civiles = $repo_estados_civiles;
        $this->repo_generos = $repo_generos;
    }


    public function login()
    {
        if (Auth::check()) { return redirect('inicio'); }
        return view('acceso.autenticacion.index');
    }

    public function iniciar_sesion(Request $request)
    {
        $resultado = $this->repo_persona->iniciar_sesion($request->input('identificacion'), $request->input('claveacceso'));


        switch($resultado[0])
        {
            case 1:

                $usuario = $resultado[2];
                Auth::login($usuario);
                Session::put('ses_ie_denominacion', $resultado[3]);
                Session::put('ses_menu', $this->repo_persona->generar_menu_aplicativo(Auth::id()));
                Session::put('ses_usuario', $usuario->nombres . ' ' . $usuario->apellidos);

                $this->repo_logs->create(['id_funcionario' => $usuario->id_funcionario, 'fecha' => date("Y-m-d"), 'hora' => date('H:i:s'), 'ip' => \Request::getClientIp()]);

                return redirect('inicio/');

                break;
            case 2:
                Toastr::info($resultado[1], $title = 'Notificación', $options = []);
                return redirect('acceso/actualizar_clave_inicial/' . $resultado[2]);
                break;

            case 3:
                Toastr::info($resultado[1], $title = 'Notificación', $options = []);
                return redirect('acceso/actualizar_info_personal/' . $resultado[2]);
                break;
            default:
                Toastr::warning($resultado[1], $title = 'Error', $options = []);
                return redirect('acceso')->withInput();
                break;
        }

    }

    public function cerrar_sesion()
    {
        Session::flush();
        Auth::logout();
        return redirect('acceso');

    }

    public function inicio()
    {
        return view('acceso.dashboard.index');
    }



    //VERIFICACION Y ACTUALIZACION DE DATOS PERSONALES
    public function actualizar_info_personal($id = null)
    {
        if($id == null)
        { return redirect('/'); }

        if($this->repo_persona->findWhere(['id_funcionario' => Crypt::decrypt($id) , ['requiere_actualizar_datos_contacto', '=', true]])->count() == 0)
        { return redirect('/'); }

        $usuario = $this->repo_persona->find(Crypt::decrypt($id));
        $list_estados_civiles = $this->repo_estados_civiles->lists('denominacion', 'id_estado_civil');
        $lis_generos = $this->repo_generos->lists('denominacion','id_genero');

        return view('acceso.autenticacion.actualizacion_info_personal', ['usuario' => $usuario, 'generos' => $lis_generos, 'estados_civiles' => $list_estados_civiles ]);
    }

    public function grabar_actualizar_info_personal(Request $request)
    {

        if($this->repo_persona->findWhere(['id_funcionario' => Crypt::decrypt($request->token_cambio), 'requiere_actualizar_datos_contacto' => 1])->count() == 0)
        { return redirect('/'); }

        $resultado = $this->repo_persona->actualizar_info_inicial($request, Crypt::decrypt($request->token_cambio));
        $usuario = $resultado[2];
        Auth::login($usuario);
        Session::put('ses_ie_denominacion', $resultado[3]);
        Session::put('ses_menu', $this->repo_persona->generar_menu_aplicativo(Auth::id()));
        Session::put('ses_usuario', $usuario->nombres . ' ' . $usuario->apellidos);
        $this->repo_logs->create(['id_funcionario' => $usuario->id_funcionario, 'fecha' => date("Y-m-d"), 'hora' => date('H:i:s'), 'ip' => \Request::getClientIp()]);
        return redirect('inicio/');

    }



    //ACTUALIZACION OBLIGATORIA DE CLAVE DE ACCESO
    public function actualizar_clave_inicial($id = null)
    {

        if($id == null)
        { return redirect('/'); }

        if($this->repo_persona->findWhere(['id_funcionario' => Crypt::decrypt($id) , ['requiere_cambio_clave', '=', true]])->count() == 0)
        { return redirect('/'); }

        $usuario = $this->repo_persona->find(Crypt::decrypt($id));

        return view('acceso.autenticacion.actualizacion_clave_inicial', ['usuario' => $usuario]);
    }

    public function grabar_actualizar_clave_inicial(Request $request)
    {
        if($this->repo_persona->findWhere(['id_funcionario' => Crypt::decrypt($request->input('token_cambio')), 'requiere_cambio_clave' => 1])->count() == 0)
        { return redirect('/'); }

        $usuario = $this->repo_persona->find(Crypt::decrypt($request->input('token_cambio')));

        if (Hash::check($request->input('old_password'), $usuario->clave_acceso))
        {
            $this->repo_persona->actualizar_clave_inicial(Crypt::decrypt($request->input('token_cambio')), Hash::make($request->input('nueva_clave')));

            Toastr::success('Su clave de acceso fue actualizada correctamente', $title = null, $options = []);
            return redirect('/');
        }
        else
        {
            Toastr::error('La clave anterior ingresada no es corecta', $title = null, $options = []);
            return redirect('acceso/actualizar_clave_inicial/' . $request->input('token_cambio'));
        }


    }



    //ACTUALIZACION VOLUNTARIA DE CLAVE DE ACCESO
    public function actualizar_clave_acceso()
    {
        return view('acceso.dashboard.actualizar_clave');
    }

    public function grabar_actualizar_clave_acceso(Request $request)
    {

        $usuario = $this->repo_persona->find(Auth::id());

        if (Hash::check($request->input('old_password'), $usuario->clave_acceso))
        {
            $this->repo_persona->actualizar_clave(Auth::id(), Hash::make($request->input('nueva_clave')));

            Toastr::success('Su clave de acceso fue actualizada correctamente', $title = null, $options = []);
            return redirect('inicio');
        }
        else
        {
            Toastr::error('La clave anterior ingresada no es corecta', $title = null, $options = []);
            return redirect('perfil/actualizar_clave_acceso');
        }
    }









}








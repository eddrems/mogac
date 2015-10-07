<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;
use App\Models\instInstitucion;

class AccessValidation {


    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

	public function handle($request, Closure $next, $identificador_acceso)
	{
        if ($this->auth->guest())
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->guest('/');
                //return redirect()->guest('auth/login');
            }
        }
//
//        if($request->user()->validar_acceso($identificador_acceso) != 1)
//            return redirect()->guest('/inicio');


        return $next($request);
	}

}

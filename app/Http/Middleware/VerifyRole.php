<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class VerifyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       list($code, $key) = explode(".", $request->route()->getName());
        if ($this->CanAccess($code, $key)) {
            return $next($request);
        }
        return abort(401);
    }

    protected function CanAccess($code, $key)
    {
        return true;
    }
    protected function GetUser()
    {
        //...
    }
    protected function GetRoles()
    {

    }
}

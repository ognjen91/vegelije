<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() === null){
            return response ("Nemate dozvolu za pristup ovom dijelu sajta. Molimo, obratite se administratoru.", 401);
          }
          $actions = $request->route()->getAction();
          $roles = isset($actions['roles'])? $actions['roles'] : null;
          if ($request->user()->hasAnyRole($roles) || !$roles){
             //ima dozvoljeni role ili nije potrebna role za pristup ruti
            return $next($request);
          }

          return response ("Nemate dozvolu za pristup ovom dijelu sajta. Molimo, obratite se administratoru.", 401);

    }
}

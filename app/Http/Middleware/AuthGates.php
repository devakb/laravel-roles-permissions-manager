<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthGates
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
        if(Auth()->check()){

            $role_id  = Auth()->user()->role_id;

            $role = Role::with('permissions')->where('id', $role_id)->first();

            if(!$role){
                abort(403);
            }

            $permissions = $role->permissions->pluck('name');

            foreach($permissions as $permission){
                Gate::define($permission, function(){
                    return true;
                });
            }

        }


        return $next($request);
    }
}

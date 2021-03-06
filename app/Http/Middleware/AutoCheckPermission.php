<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AutoCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName(); //user.create
        $permission = Permission::whereRaw("FIND_IN_SET ('$routeName', routes)")->first();
        if ($permission) {
            if (!$request->user()->can($permission->name)) {
                abort(403);
            }
        } else {
            abort(403);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Area
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUser = \Auth::user();
        if (!$currentUser->can('admin')) {
            switch (true) {
                case $currentUser->can('department.development'):
                    return redirect(url('admin/development/dashboard'));
                    break;
                case $currentUser->can('department.partners'):
                    return redirect(url('admin/partners/dashboard'));
                    break;
                case $currentUser->can('department.operation'):
                    return redirect(url('admin/operation/dashboard'));
                    break;
                case $currentUser->can('department.director'):
                    return redirect(url('admin/director/dashboard'));
                    break;
                case $currentUser->can('department.orphan'):
                    return redirect(url('admin/orphan/dashboard'));
                    break;
                }
        }

        return $next($request);
    }
}

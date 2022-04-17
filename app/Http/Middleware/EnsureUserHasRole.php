<?php

namespace App\Http\Middleware;

use Closure;

class EnsureUserHasRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        // if (!auth()->check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
        //     return redirect()->route('signIn');

        // return dd($roles);
        // if (auth()->user()->isSuperadmin())
        //     return $next($request);

        // if (in_array(auth()->user()->role, explode(',', $roles)))

        // foreach ($roles as $role) {
        //     // Check if user has the role This check will depend on how your roles are set up
        //     if (auth()->user()->role == $role)
        //         return $next($request);
        // }


        foreach ($roles as $role) {
            if ($role === "superadmin" && auth()->user()->isSuperadmin()) return $next($request);

            if ($request->user()->role === $role) {
                return $next($request);
            }
        }

        // return abort(403);
        return redirect()->route('dashboard')->with('errorMessage', 'You don\'t have permission to access the page');
    }
}

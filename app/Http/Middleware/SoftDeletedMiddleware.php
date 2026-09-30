<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SoftDeletedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::withTrashed()->find($request->route('user'));

        if ($user->trashed() || $user->status == 'deactivated') {
            return $next($request);
        }
        return redirect()->route('UserDashboard')->with('danger', 'Invalid request or account active');

    }
}

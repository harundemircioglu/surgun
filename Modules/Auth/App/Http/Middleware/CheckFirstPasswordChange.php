<?php

namespace Modules\Auth\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Auth\App\Models\User;

class CheckFirstPasswordChange
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(auth()->id());

        if ($user->is_changed_first_password == false) {
            return redirect()->route('auth.changeFirstPasswordIndex');
        }

        return $next($request);
    }
}

<?php

namespace Modules\Auth\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActiveStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->is_active) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/')->with('error', 'Hesabınız pasif durumda. Lütfen yöneticiniz ile iletişime geçiniz.');
        }

        return $next($request);
    }
}

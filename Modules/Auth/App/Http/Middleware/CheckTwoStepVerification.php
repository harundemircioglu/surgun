<?php

namespace Modules\Auth\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Auth\App\Models\TwoFactorCode;
use Modules\Auth\App\Models\User;

class CheckTwoStepVerification
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->two_step_verification == true) {
            $code = TwoFactorCode::where('user_id', $user->id)
                ->whereNull('verified_at')
                ->where('expires_at', '>', now())
                ->latest()
                ->first();

            if ($code) {
                return redirect()->route('auth.twoStepVerificationIndex');
            }
        }

        return $next($request);
    }
}

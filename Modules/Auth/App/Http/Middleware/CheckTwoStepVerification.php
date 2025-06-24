<?php

namespace Modules\Auth\App\Http\Middleware;

use Carbon\Carbon;
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
            $twoStepVerification = TwoFactorCode::where('user_id', $user->id)
                ->whereNotNull('verified_at')
                ->latest()
                ->first();

            if ((!$twoStepVerification) || ($twoStepVerification && Carbon::parse($twoStepVerification->verified_at)->addHours(2)->isPast())) {
                return redirect()->route('auth.twoStepVerificationIndex');
            }
        }

        return $next($request);
    }
}

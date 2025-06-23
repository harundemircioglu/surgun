<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\App\Emails\TwoStepVerification;
use Modules\Auth\App\Http\Requests\ChangeFirstPasswordRequest;
use Modules\Auth\App\Http\Requests\LoginRequest;
use Modules\Auth\App\Models\TwoFactorCode;
use Modules\Auth\App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('auth::login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            return redirect()->route('dashboard.index');
        }

        return redirect()->back()->with(['error' => 'Error']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function changeFirstPasswordIndex()
    {
        return view('auth::changeFirstPassword');
    }

    public function changeFirstPassword(ChangeFirstPasswordRequest $request)
    {
        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->is_changed_first_password = true;
        $user->save();

        return $this->logout($request);
    }

    public function twoStepVerificationIndex()
    {
        return view('auth::twoStepVerification');
    }

    public function sendTwoStepVerificationCode()
    {
        $user = auth()->user();

        $twoFactorCode = TwoFactorCode::where('user_id', $user->id)
            ->whereNull('verified_at')
            ->where('expires_at', '>', now()->subMinutes(3))
            ->latest()
            ->first();

        if ($twoFactorCode) {
            return response()->json([
                'status' => 0,
                'message' => 'A code has already been sent.'
            ], 400);
        }

        $code = generateTwoFactorCode();

        $twoFactorCode = TwoFactorCode::create([
            'user_id' => auth()->id(),
            'code' => $code,
            'ip_address' => request()->ip(),
            'expires_at' => now()->addMinutes(3),
            'user_agent' => request()->userAgent(),
        ]);

        try {
            Mail::to($user->email)->send(new TwoStepVerification($code));

            return response()->json([
                'status' => 1,
                'message' => 'A verification code has been sent to your email.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 0,
                'message' => 'Failed to send verification code. Please try again later.'
            ], 500);
        }
    }

    public function verifyTwoStepVerificationCode(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ]);

        $user = auth()->user();

        $twoFactorCode = TwoFactorCode::where('user_id', $user->id)
            ->where('code', $request->code)
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->first();

        if (!$twoFactorCode) {
            return response()->json([
                'status' => 0,
                'message' => 'Invalid or expired code.'
            ], 400);
        }

        $twoFactorCode->update([
            'verified_at' => now(),
        ]);

        return redirect()->route('dashboard.index');
    }
}

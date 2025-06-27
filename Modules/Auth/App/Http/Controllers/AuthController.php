<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        return redirect()->back()->with(['error' => 'Hata!']);
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
        DB::transaction(function () use ($request) {
            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->is_changed_first_password = true;
            $user->save();
        });

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
            ->latest()
            ->first();

        if ($twoFactorCode && Carbon::parse($twoFactorCode->expires_at)->isFuture()) {
            return response()->json([
                'error' => 'Bir doğrulama kodu zaten gönderildi.'
            ], 422);
        }

        $code = generateTwoFactorCode();

        DB::transaction(function () use ($code) {
            TwoFactorCode::create([
                'user_id' => auth()->id(),
                'code' => $code,
                'ip_address' => request()->ip(),
                'expires_at' => now()->addMinutes(3),
                'user_agent' => request()->userAgent(),
            ]);
        });

        try {
            Mail::to($user->email)->send(new TwoStepVerification($code));

            return response()->json([
                'success' => 'E-posta adresinize bir doğrulama kodu gönderildi.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Doğrulama kodu gönderilemedi. Lütfen daha sonra tekrar deneyin.'
            ], 500);
        }
    }

    public function verifyTwoStepVerificationCode(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ], [
            'code.required' => 'Doğrulama kodu zorunludur.',
            'code.integer' => 'Doğrulama kodu sadece rakamlardan oluşmalıdır.',
        ]);

        $user = auth()->user();

        $twoFactorCode = TwoFactorCode::where('user_id', $user->id)
            ->where('code', $request->code)
            ->whereNull('verified_at')
            ->latest()
            ->first();

        if ((!$twoFactorCode) || ($twoFactorCode && Carbon::parse($twoFactorCode->expires_at)->isPast())) {
            return response()->json([
                'error' => 'Geçersiz veya süresi dolmuş kod.'
            ], 422);
        }

        DB::transaction(function () use ($twoFactorCode) {
            $twoFactorCode->update([
                'verified_at' => now(),
            ]);
        });

        return redirect()->route('dashboard.index');
    }
}

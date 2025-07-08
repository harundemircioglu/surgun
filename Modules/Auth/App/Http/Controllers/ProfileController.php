<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\App\Http\Requests\Profile\UpdatePasswordRequest;
use Modules\Auth\App\Http\Requests\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        return view('auth::user.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        $user->update($data);
        $user->save();

        return back()->with('success', 'Profil bilgileri başarıyla güncellenlendi');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();
        $password = $request->password;

        $user->password = Hash::make($password);
        $user->save();

        return back()->with('success', 'Şifre başarıyla güncellenlendi');
    }

    public function changeTwoStepVerificationStatus()
    {
        $user = auth()->user();

        $twoStepVerification = true;

        if ($user->two_step_verification) {
            $twoStepVerification = false;
        }

        $user->two_step_verification = $twoStepVerification;
        $user->save();

        return response()->json([
            'success' => 'İki adımlı doğrulama durumu başarıyla güncellendi',
        ], 200);
    }
}

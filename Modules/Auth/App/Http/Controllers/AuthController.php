<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\App\Http\Requests\ChangeFirstPasswordRequest;
use Modules\Auth\App\Http\Requests\LoginRequest;
use Modules\Auth\App\Models\User;

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
}

<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Auth\App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('auth::login');
    }

    public function login(LoginRequest $request)
    {
        dd($request->all());
    }
}

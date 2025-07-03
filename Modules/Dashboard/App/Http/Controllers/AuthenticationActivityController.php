<?php

namespace Modules\Dashboard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Auth\App\Models\AuthenticationActivity;

class AuthenticationActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = AuthenticationActivity::with('user')
            ->paginate(30);

        return view('dashboard::authenticationActivities', compact('activities'));
    }
}

<?php

namespace Modules\Auth\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Mail;
use Modules\Auth\App\Emails\TemporaryPassword;
use Modules\Auth\App\Http\Requests\Store\UserRequest;
use Modules\Auth\App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('is_active', true)
            ->whereIn('role', [2, 3])
            ->with(['roles', 'permissions'])
            ->paginate(10);

        $roles = Role::select(['id', 'name', 'description'])
            ->whereNot('name', 'super-admin')
            ->get();

        $permissions = Permission::select(['id', 'description'])
            ->get();

        return view('auth::user.index', compact('users', 'roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $password = Str::random(8);

        $user = new User();
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = bcrypt($password);
        $user->role = $data['role'];
        $user->assignRole(Role::find($data['role'])->name);
        $user->givePermissionTo(Permission::whereIn('id', $data['permissions'])->pluck('name'));
        $user->save();

        try {
            Mail::to($user->email)->send(new TemporaryPassword($password));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return back()->with('success', 'User created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('auth::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('auth::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Modules\Auth\App\Http\Requests\Update\UserRequest $request, $id): RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $data = $request->validated();

        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->role = $data['role'];
        $user->syncRoles(Role::find($data['role'])->name);
        $user->syncPermissions(Permission::whereIn('id', $data['permissions'])->pluck('name'));
        $user->save();

        return back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}

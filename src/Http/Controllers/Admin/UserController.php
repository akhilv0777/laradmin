<?php

namespace Akhilesh\Laradmin\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(20);
        $roles = Role::orderBy('name')->get();
        return view('laradmin::admin.users.index', compact('users','roles'));
    }

    public function assignRole(User $user, Request $request)
    {
        $data = $request->validate(['role'=>['required','string']]);
        if ($data['role'] === 'super_admin' && !auth()->user()->hasRole('super_admin')) abort(403);
        $user->assignRole($data['role']);
        return back()->with('status','Role assigned');
    }

    public function removeRole(User $user, string $role)
    {
        if ($role === 'super_admin') abort(403);
        $user->removeRole($role);
        return back()->with('status','Role removed');
    }
}

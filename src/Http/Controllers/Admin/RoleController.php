<?php

namespace Akhilesh\Laradmin\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('laradmin::admin.roles.index', [
            'roles' => Role::orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name'=>['required','string','max:50']]);
        if ($data['name'] === 'super_admin') {
            return back()->withErrors(['name'=>'Reserved role']);
        }
        Role::findOrCreate($data['name']);
        return back()->with('status','Role created');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'super_admin') abort(403);
        $role->delete();
        return back()->with('status','Role deleted');
    }
}

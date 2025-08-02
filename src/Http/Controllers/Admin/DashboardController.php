<?php

namespace Akhilesh\Laradmin\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        return view('laradmin::admin.dashboard', [
            'usersCount' => User::count(),
            'rolesCount' => Role::count(),
        ]);
    }
}

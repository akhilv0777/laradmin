<?php

namespace Akhilesh\Laradmin\Http\Controllers\User;

use Illuminate\Routing\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Yahan aap user-specific data bhej sakte ho (e.g., recent activity, profile, etc.)
        return view('laradmin::user.dashboard');
    }
}

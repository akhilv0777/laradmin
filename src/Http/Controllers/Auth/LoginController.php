<?php

namespace Akhilesh\Laradmin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Akhilesh\Laradmin\Traits\AuthenticatesUsersManually;

class LoginController extends Controller
{
    use AuthenticatesUsersManually;

    public function show()
    {
        return view('laradmin::auth.auth');
    }

    public function store(Request $request)
    {
        if (!$this->attemptLogin($request)) {
            return back()->withErrors(['email'=> 'Invalid credentials'])->withInput();
        }

        $request->session()->regenerate();
        // ✅ Role-based redirect
        $user = $request->user();
        if ($user->hasRole('super_admin')) {
            return redirect()->route('laradmin.dashboard'); 
        }
        return redirect()->route('laradmin.user.dashboard'); 
    }
}

<?php

namespace Akhilesh\Laradmin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForcePasswordController extends Controller
{
    public function show()
    {
        return view('laradmin::auth.auth');
    }

    public function update(Request $request)
    {
        $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);
        $user = $request->user();
        $user->forceFill([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ])->save();

        return redirect()->intended(route('laradmin.dashboard'));
    }
}

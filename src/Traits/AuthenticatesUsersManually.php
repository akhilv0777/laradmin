<?php

namespace Akhilesh\Laradmin\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait AuthenticatesUsersManually
{
    protected function validateLogin(Request $request): array
    {
        return $request->validate([
            'email' => ['required','email'],
            'password' => ['required','string'],
        ]);
    }

    protected function attemptLogin(Request $request): bool
    {
        $creds = $this->validateLogin($request);
        return Auth::attempt($creds, $request->boolean('remember'));
    }
}

<?php

namespace App\Services;

use App\Actions\Auth\LoginAdminAction;
use App\Actions\Auth\LogoutAdminAction;
use Illuminate\Http\Request;

class AuthService
{
    public function login(array $credentials, Request $request): void
    {
        LoginAdminAction::process($credentials);
        $request->session()->regenerate();
    }

    public function logout(Request $request): void
    {
        LogoutAdminAction::process([
            'request' => $request,
        ]);
    }
}

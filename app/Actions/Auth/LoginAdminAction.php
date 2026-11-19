<?php

namespace App\Actions\Auth;

use App\Data\Auth\AdminLoginData;
use Illuminate\Support\Facades\Auth;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class LoginAdminAction extends CustomActionBuilder
{
    public function handle(AdminLoginData $customData): void
    {
        Auth::attempt([
            'email' => $customData->email,
            'password' => $customData->password,
        ]);
    }
}

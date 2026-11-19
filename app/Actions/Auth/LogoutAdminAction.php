<?php

namespace App\Actions\Auth;

use App\Data\Auth\AdminLogoutData;
use Illuminate\Support\Facades\Auth;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class LogoutAdminAction extends CustomActionBuilder
{
    public function handle(AdminLogoutData $customData): void
    {
        Auth::logout();
        $customData->request->session()->invalidate();
        $customData->request->session()->regenerateToken();
    }
}

<?php

namespace App\Data\Auth;

use Illuminate\Http\Request;
use Kakaprodo\CustomData\CustomData;

class AdminLogoutData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'request' => $this->property(Request::class),
        ];
    }
}

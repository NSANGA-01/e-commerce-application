<?php

namespace App\Data\Auth;

use Kakaprodo\CustomData\CustomData;

class AdminLoginData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'email' => $this->property()->string(),
            'password' => $this->property()->string(),
        ];
    }
}

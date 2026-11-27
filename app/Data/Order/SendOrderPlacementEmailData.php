<?php

namespace App\Data\Order;

use App\Models\Order;
use Kakaprodo\CustomData\CustomData;

class SendOrderPlacementEmailData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'order' => $this->property(Order::class),
        ];
    }
}

<?php

namespace App\Data\Order;

use App\Models\Order;
use Kakaprodo\CustomData\CustomData;

class UpdateOrderStatusData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'order' => $this->property(Order::class),
            'status' => $this->property()->string(),
        ];
    }
}

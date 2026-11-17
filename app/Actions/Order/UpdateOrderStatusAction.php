<?php

namespace App\Actions\Order;

use App\Data\Order\UpdateOrderStatusData;
use App\Models\Order;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class UpdateOrderStatusAction extends CustomActionBuilder
{
    public function handle(UpdateOrderStatusData $customData): Order
    {
        $order = $customData->order;
        $order->update([
            'status' => $customData->status,
        ]);

        return $order->refresh();
    }
}

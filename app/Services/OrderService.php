<?php

namespace App\Services;

use App\Actions\Order\CreateGuestOrderAction;
use App\Actions\Order\SendOrderPlacementEmailAction;
use App\Actions\Order\UpdateOrderStatusAction;
use App\Models\Order;

class OrderService
{
    public function __construct() {}

    public function processGuestCheckout(array $payloadFromRequest): Order
    {
        return CreateGuestOrderAction::process($payloadFromRequest);
    }

    public function updateStatus(Order $order, array $attributes): Order
    {
        return UpdateOrderStatusAction::process([
            ...$attributes,
            'order' => $order,
        ]);
    }

    public function sendPlacementNotification(Order $order): void
    {
        SendOrderPlacementEmailAction::process([
            'order' => $order,
        ]);
    }
}

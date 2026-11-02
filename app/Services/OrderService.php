<?php

namespace App\Services;

use App\Actions\Order\CreateGuestOrderAction;
use App\Data\Order\CheckoutOrderData;
use App\Models\Order;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected CreateGuestOrderAction $createGuestOrderAction
    ) {}

    public function processGuestCheckout(CheckoutOrderData $data): Order
    {
        return $this->createGuestOrderAction->execute($data);
    }
}


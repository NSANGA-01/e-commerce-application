<?php

namespace App\Services;

use App\Actions\Order\CreateGuestOrderAction;
use App\Data\Order\CheckoutOrderData;
use App\Models\Order;

class OrderService
{
   
    public function __construct() {}

    public function processGuestCheckout(CheckoutOrderData $data): Order
    {
        $data = CheckoutOrderData::make($data->validated());

        return CreateGuestOrderAction::process($data);
    }
}


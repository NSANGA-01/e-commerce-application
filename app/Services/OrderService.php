<?php

namespace App\Services;

use App\Actions\Order\CreateGuestOrderAction;
use App\Data\Order\CheckoutOrderData;
use App\Models\Order;

class OrderService
{
   
    public function __construct() {}

    public function processGuestCheckout(array $payloadFromRequest): Order
    {
       
      return CreateGuestOrderAction::process($payloadFromRequest);
    }
}


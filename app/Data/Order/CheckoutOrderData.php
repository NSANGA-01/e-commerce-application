<?php
namespace App\Data\Order;

use Kakaprodo\CustomData\CustomData;

class CheckoutOrderData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'customerName' => $this->dataType()->string(),
            'customerEmail' => $this->dataType()->string(),
            'customerPhone' => $this->dataType()->string(),
            'shipping_address' => $this->dataType()->string(),
            'items' => $this->dataType()->array(),
        ];
    }
}
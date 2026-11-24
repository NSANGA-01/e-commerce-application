<?php

namespace App\Actions\Order;

use App\Data\Order\SendOrderPlacementEmailData;
use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Mail;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class SendOrderPlacementEmailAction extends CustomActionBuilder
{
    public function handle(SendOrderPlacementEmailData $customData): void
    {
        $order = $customData->order->load('orderItems.product');

        Mail::to($order->customer_email)->send(
            new OrderPlacedMail($order)
        );

        $adminEmail = config('mail.admin_address');

        if ($adminEmail && strcasecmp($adminEmail, $order->customer_email) !== 0) {
            Mail::to($adminEmail)->send(
                new OrderPlacedMail($order, true)
            );
        }
    }
}

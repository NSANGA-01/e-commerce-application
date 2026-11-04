<?php

namespace App\Actions\Order;

use App\Data\Order\CheckoutOrderData;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class CreateGuestOrderAction 
{
   
     public function handle(CheckoutOrderData $customData): Order
    {
        return DB::transaction(function () {
            $order = new Order([
                'order_number' => (string) Str::uuid(),
                'customer_name' => $this->customData->customer_name,
                'customer_email' => $this->customData->customer_email,
                'customer_phone' => $this->customData->customer_phone,
                'shipping_address' => $this->customData->shipping_address,
                'total_amount' => 0,
                'status' => 'pending',
            ]);

            $order->save();
            $totalAmount = 0;

            foreach ($this->customData->items as $itemData) {
                $product = Product::find($itemData['product_id']);

                if (!$product) {
                    throw ValidationException::withMessages([
                        'items' => "Product with ID {$itemData['product_id']} not found.",
                    ]);
                }

                if ($product->stock < $itemData['quantity']) {
                    throw ValidationException::withMessages([
                        'items' => "Insufficient stock for product {$product->name}.",
                    ]);
                }

                $itemTotalPrice = $product->price * $itemData['quantity'];
                $totalAmount += $itemTotalPrice;

                // Create order item
                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $itemData['quantity'],
                    'price' => $product->price,
                    'total' => $itemTotalPrice,
                ]);

                // Update product stock
                $product->decrement('stock', $itemData['quantity']);
            }

            // Update total amount for the order
            $order->total_amount = $totalAmount;
            $order->save();

            return $order;
        });
    }

}
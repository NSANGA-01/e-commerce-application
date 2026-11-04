<?php
namespace App\Data\Order;

use Kakaprodo\CustomData\CustomData;

class CheckoutOrderData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'customer_name' => $this->property()->string(),
            'customer_email' => $this->property()->string(),
            'customer_phone' => $this->property()->string(),
            'shipping_address' => $this->property()->string(),
            'items' => $this->property()->array(),
        ];
    }

    public function boot(): void
    {
        foreach ($this->items as $itemData) {
            $product = Product::find($itemData['product_id'] ?? null);

            if (!$product) {
                throw ValidationException::withMessages([
                    'items' => "Product with ID " . ($itemData['product_id'] ?? '') . " not found.",
                ]);
            }

            if ($product->stock < ($itemData['quantity'] ?? 0)) {
                throw ValidationException::withMessages([
                    'items' => "Insufficient stock for product {$product->name}.",
                ]);
            }
        }
    }
}
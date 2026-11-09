<?php

namespace App\Actions\Product;

use App\Data\Product\UpdateProductData;
use App\Models\Product;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class UpdateProductAction extends CustomActionBuilder
{
    public function handle(UpdateProductData $customData): Product
    {
        $product = Product::findOrFail($customData->product_id);
        $attributes = $customData->__toArray();
        unset($attributes['product_id']);
        $product->update($attributes);

        return $product->refresh();
    }
}

<?php

namespace App\Actions\Product;

use App\Data\Product\UpdateProductData;
use App\Models\Product;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class UpdateProductAction extends CustomActionBuilder
{
    public function handle(UpdateProductData $customData): Product
    {
        $product = $customData->product;
        $attributes = $customData->except(['product']);
        $product->update($attributes);

        return $product->refresh();
    }
}

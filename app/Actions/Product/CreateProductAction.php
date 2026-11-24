<?php

namespace App\Actions\Product;

use App\Data\Product\ProductData;
use App\Models\Product;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class CreateProductAction extends CustomActionBuilder
{
    public function handle(ProductData $customData): Product
    {
        return Product::create($customData->onlyValidated());
    }
}

<?php

namespace App\Actions\Product;

use App\Data\Product\DeleteProductData;
use App\Models\Product;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class DeleteProductAction extends CustomActionBuilder
{
    public function handle(DeleteProductData $customData): void
    {
        Product::findOrFail($customData->product_id)->delete();
    }
}

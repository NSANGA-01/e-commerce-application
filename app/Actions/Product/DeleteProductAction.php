<?php

namespace App\Actions\Product;

use App\Data\Product\DeleteProductData;
use Kakaprodo\CustomData\Helpers\CustomActionBuilder;

class DeleteProductAction extends CustomActionBuilder
{
    public function handle(DeleteProductData $customData): void
    {
        $customData->product->delete();
    }
}

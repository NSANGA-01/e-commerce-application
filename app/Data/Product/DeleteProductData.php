<?php

namespace App\Data\Product;

use App\Models\Product;
use Kakaprodo\CustomData\CustomData;

class DeleteProductData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'product' => $this->property(Product::class),
        ];
    }
}

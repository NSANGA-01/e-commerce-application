<?php

namespace App\Data\Product;

use App\Models\Product;

class UpdateProductData extends ProductData
{
    public function expectedProperties(): array
    {
        return [
            'product' => $this->property(Product::class),
            ...parent::expectedProperties(),
        ];
    }
}

<?php

namespace App\Data\Product;

class UpdateProductData extends ProductData
{
    public function expectedProperties(): array
    {
        return [
            'product_id' => $this->property('integer'),
            ...parent::expectedProperties(),
        ];
    }
}

<?php

namespace App\Data\Product;

use Kakaprodo\CustomData\CustomData;

class DeleteProductData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'product_id' => $this->property('integer'),
        ];
    }
}

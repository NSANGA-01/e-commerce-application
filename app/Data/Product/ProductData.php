<?php

namespace App\Data\Product;

use Kakaprodo\CustomData\CustomData;

class ProductData extends CustomData
{
    public function expectedProperties(): array
    {
        return [
            'name' => $this->property()->string(),

            'description' => $this->property()->string(),

            'price' => $this->property()->numeric(),

            'image?' => $this->property()->string(),

            'stock' => $this->property()->number(),
             
            'is_active' => $this->property()->bool(),
        ];
    }
}

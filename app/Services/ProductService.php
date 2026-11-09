<?php

namespace App\Services;

use App\Actions\Product\CreateProductAction;
use App\Actions\Product\DeleteProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Models\Product;

class ProductService
{

    public function create(array $attributes): Product
    {
        if (isset($attributes['stock'])) {
        $attributes['stock'] = (int) $attributes['stock'];
         }
        return CreateProductAction::process($attributes);
    }


    public function update(Product $product, array $attributes): Product
    {
        return UpdateProductAction::process([
            ...$attributes,
            'product_id' => $product->id,
        ]);
    }

    public function delete(Product $product): void
    {
        DeleteProductAction::process([
            'product_id' => $product->id,
        ]);
    }
}

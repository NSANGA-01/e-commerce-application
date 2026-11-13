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
        return CreateProductAction::process($attributes);
    }


    public function update(Product $product, array $attributes): Product
    {
        return UpdateProductAction::process([
            ...$attributes,
            'product' => $product,
        ]);
    }

    public function delete(Product $product): void
    {
        DeleteProductAction::process([
            'product' => $product,
        ]);
    }
}

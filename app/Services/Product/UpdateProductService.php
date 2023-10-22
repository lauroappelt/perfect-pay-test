<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductService implements ProductService
{
    public function handle(array $params, string $id): Product
    {
        $product = Product::findOrFail($id);
        $product->fill($params);
        $product->save();

        return $product;
    }
}

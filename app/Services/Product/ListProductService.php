<?php
namespace App\Services\Product;

use App\Models\Product\Product;

class ListProductService implements ProductService
{
    public function handle(array $params)
    {
        return Product::paginate(15)->toArray();
    }
}
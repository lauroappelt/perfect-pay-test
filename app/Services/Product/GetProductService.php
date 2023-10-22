<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetProductService implements ProductService
{
    public function handle(string $id): Product
    {
        return Product::findOrFail($id);
    }
}

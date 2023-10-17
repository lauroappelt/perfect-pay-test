<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetProductService implements ProductService
{
    public function handle(string $id): Product
    {
        try {
            return Product::findOrFail($id);
        } catch (ModelNotFoundException $notFoundException) {
            throw new Exception("Resource not found", 404);
        }
    }
}

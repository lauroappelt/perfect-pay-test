<?php 
namespace App\Services\Product;

use App\Models\Product\Product;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateProductService implements ProductService
{
    public function handle(array $params, string $id): Product
    {
        try {
            $product = Product::findOrFail($id);
            $product->fill($params);
            $product->save();

            return $product;

        } catch (ModelNotFoundException $notFoundException) {
            throw new Exception("Resource not found", 404);
        }
    }
} 
<?php
namespace App\Services\Product;

use App\Models\Product\Product;
use App\Services\Product\ProductService;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;

class CreateProductService implements ProductService
{
    public function handle(array $params): Product
    {
        try {
            return Product::create($params);
        } catch (UniqueConstraintViolationException $exception) {
           throw new Exception("One or more fields already exists", 422);
        }
    }
}
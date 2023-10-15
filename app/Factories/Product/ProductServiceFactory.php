<?php

namespace App\Factories\Product;

use App\Services\Product\CreateProductService;
use App\Services\Product\UpdateProductService;

class ProductServiceFactory
{
    public static function create()
    {
        $currentAction = app('request')->route()->getActionMethod();
        switch ($currentAction) {
            case 'createProduct':
                return new CreateProductService();
            case 'updateProduct':
                return new UpdateProductService();
        }
    }
}

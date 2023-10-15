<?php

namespace App\Factories\Product;

use App\Services\Product\CreateProductService;

class ProductServiceFactory
{
    public static function create()
    {
        $currentAction = app('request')->route()->getActionMethod();
        switch ($currentAction) {
            case 'createProduct':
                return new CreateProductService();
        }
    }
}

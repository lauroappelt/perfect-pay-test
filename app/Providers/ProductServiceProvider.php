<?php

namespace App\Providers;

use App\Http\Controllers\Api\Product\ProductController;
use App\Services\Product\ProductService;
use Illuminate\Support\ServiceProvider;
use App\Factories\Product\ProductServiceFactory;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->app->when(ProductController::class)
        //     ->needs(ProductService::class)
        //     ->give(function (){
        //         return ProductServiceFactory::create();
        //     });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

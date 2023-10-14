<?php

namespace App\Providers;

use App\Http\Controllers\Api\Costomer\CostomerController;
use App\Services\Costomer\CostomerService;
use App\Services\Costomer\CreateCostomerService;
use App\Services\Costomer\UpdateCostomerService;
use Illuminate\Support\ServiceProvider;

class CostomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(CostomerController::class)
            ->needs(CostomerService::class)
            ->give(function(){
                $currentAction = app('request')->route()->getActionMethod();

                switch ($currentAction) {
                    case 'createCostomer':
                        return new CreateCostomerService();
                    case 'updateCostomer':
                        return new UpdateCostomerService();
                }
            });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

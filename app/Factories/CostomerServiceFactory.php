<?php
namespace App\Factories;

use App\Services\Costomer\CreateCostomerService;
use App\Services\Costomer\UpdateCostomerService;
use App\Services\Costomer\GetCostomerService;
use App\Services\Costomer\ListCostomerService;
use Symfony\Component\Console\Command\ListCommand;

class CostomerServiceFactory
{
    public static function create()
    {
        $currentAction = app('request')->route()->getActionMethod();
        switch ($currentAction) {
            case 'createCostomer':
                return new CreateCostomerService;
            case 'updateCostomer':
                return new UpdateCostomerService;
            case 'getCostomer':
                return new GetCostomerService;
            case 'listCostomer':
                return new ListCostomerService;
        }
    }
}
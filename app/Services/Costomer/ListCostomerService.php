<?php
namespace App\Services\Costomer;

use App\Models\Costomer\Costomer;

class ListCostomerService implements CostomerService
{
    public function handle(array $params): array
    {
        return Costomer::paginate(15)->toArray();
    }
}
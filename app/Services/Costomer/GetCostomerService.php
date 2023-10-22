<?php

namespace App\Services\Costomer;

use App\Models\Costomer\Costomer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetCostomerService implements CostomerService
{
    public function handle(string $id): Costomer
    {
        return Costomer::findOrFail($id);
    }
}

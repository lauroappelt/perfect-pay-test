<?php

namespace App\Services\Costomer;

use App\Models\Costomer\Costomer;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetCostomerService implements CostomerService
{
    public function handle(string $id): Costomer
    {
        try {
            return Costomer::findOrFail($id);
        } catch (ModelNotFoundException $notFoundException) {
            throw new Exception("Resource not found", 404);
        }
    }
}

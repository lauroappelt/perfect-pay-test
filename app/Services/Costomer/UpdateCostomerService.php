<?php

namespace App\Services\Costomer;

use App\Exceptions\Costomer\DuplicateCostomerException;
use App\Models\Costomer\Costomer;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateCostomerService implements CostomerService
{
    public function handle(array $params, string $id): Costomer
    {
        try {
            $costomer = Costomer::findOrFail($id); //trows not found
            $costomer->fill($params);
            $costomer->save();

            return $costomer;
        } catch (UniqueConstraintViolationException $exception) {
            throw new DuplicateCostomerException("One or more fields already exists");
        }
    }
}

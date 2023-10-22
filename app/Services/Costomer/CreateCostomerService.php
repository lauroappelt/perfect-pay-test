<?php

namespace App\Services\Costomer;

use App\Exceptions\Costomer\DuplicateCostomerException;
use App\Models\Costomer\Costomer;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Throwable;

class CreateCostomerService implements CostomerService
{
    public function handle(array $params): Costomer
    {
        try {
            return Costomer::create($params);
        } catch (UniqueConstraintViolationException $exception) {
            throw new DuplicateCostomerException("One or more fields already exists");
        }
    }
}

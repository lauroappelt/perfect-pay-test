<?php

namespace App\Services\Costomer;

use App\Models\Costomer\Costomer;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateCostomerService
{
    public function handle(array $params, string $id): Costomer
    {
        try {
            $costomer = Costomer::findOrFail($id); //trows not found
            $costomer->fill($params);
            $costomer->save();

            return $costomer;
        } catch (UniqueConstraintViolationException $exception) {
            throw new \Exception("One or more fields already exists", 422);
        } catch (ModelNotFoundException $notFoundException) {
            throw new \Exception("Resource not found", 404);
        }
    }
}

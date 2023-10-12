<?php
namespace App\Services\Costomer;

use App\Models\Costomer\Costomer;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Throwable;

class CreateCostomerService
{
    public function handle(array $params): Costomer
    {
        
        try {
            return Costomer::create($params);
        } catch (UniqueConstraintViolationException $exception) {
           throw new Exception($exception->getMessage(), 400);
        }
    }
}
<?php

namespace App\States\Sale;

use App\Models\Sale\Sale;
use Exception;

abstract class SaleState
{
    public function __construct(
        protected Sale $sale
    ) {}

    public function changeToPaid()
    {
        throw new Exception("Invalid state transiction");
    }

    public function changeToCompleted()
    {
        throw new Exception("Invalid state transiction");
    }

    public function changeToCanceled()
    {
        throw new Exception("Invalid state transiction");
    }
}

<?php

namespace App\States\Sale;

use App\Exceptions\Sale\InvalidTransitionException;
use App\Models\Sale\Sale;
use Exception;

abstract class SaleState
{
    public function __construct(
        protected Sale $sale
    ) {}

    public function pay()
    {
        throw new InvalidTransitionException("Current status does not allows transtition to paid state");
    }

    public function finalize()
    {
        throw new InvalidTransitionException("Current status does not allows transtition to completed state");
    }

    public function cancel()
    {
        throw new InvalidTransitionException("Current status does not allows transtition to canceled state");
    }
}

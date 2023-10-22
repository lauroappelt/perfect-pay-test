<?php

namespace App\Services\Sale;

use App\Enums\Sale\SaleEnum;
use App\Models\Sale\Sale;

class TransitionStatusService
{
    public function handle(string $id, string $newStatus) 
    {   
        $sale = Sale::findOrFail($id);
        if ($newStatus == SaleEnum::Canceled->value) {
            $sale->getState()->cancel();
        } else if ($newStatus == SaleEnum::Paid->value) {
            $sale->getState()->pay();
        } else if ($newStatus == SaleEnum::Completed->value) {
            $sale->getState()->finalize();
        }
    }
}

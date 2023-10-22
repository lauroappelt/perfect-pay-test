<?php

namespace App\Services\Sale;

use Ramsey\Uuid\Uuid;
use App\Models\Sale\Sale;
use App\Enums\Sale\SaleEnum;

class CreateSaleService
{
    public function handle(array $params) {
        
        $sale = new Sale($params);
        $sale->id = Uuid::uuid4();
        $sale->status = SaleEnum::WaitingPayment->value;
        $sale->date = now('America/Sao_Paulo');
        $sale->save();

        return $sale;
    }
}

<?php
namespace App\Services\Sale;

use App\Models\Sale\Sale;

class GetSaleService
{
    public function handle($id): Sale
    {
        return Sale::findOrFail($id);
    }
}
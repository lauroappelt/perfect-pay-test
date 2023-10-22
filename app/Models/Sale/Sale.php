<?php

namespace App\Models\Sale;

use App\States\SaleState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Sale\SaleEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sale extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'product_id',
        'costomer_id',
        'date',
        'ammount',
        'discount',
        'status'
    ];

    public $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function getState() {
        return SaleEnum::from($this->status)->createSaleState($this);
    }
}

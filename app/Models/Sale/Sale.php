<?php

namespace App\Models\Sale;

use App\States\Sale\SaleState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Sale\SaleEnum;
use Database\Factories\SaleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

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

    /**
    * Create a new factory instance for the model.
    */
    protected static function newFactory(): Factory
    {
        return SaleFactory::new();
    }

    public function getState(): SaleState
    {
        return SaleEnum::from($this->status)->createSaleState($this);
    }
}

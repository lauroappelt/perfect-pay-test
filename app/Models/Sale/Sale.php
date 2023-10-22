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

    public function status(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => SaleEnum::from($value)->createSaleState($this),
        );
    }   
}

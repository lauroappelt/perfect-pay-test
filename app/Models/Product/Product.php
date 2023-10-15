<?php

namespace App\Models\Product;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;


class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'price'
    ];

    /**
    * Create a new factory instance for the model.
    */
    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }
}

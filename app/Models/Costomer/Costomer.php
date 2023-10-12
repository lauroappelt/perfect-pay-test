<?php

namespace App\Models\Costomer;

use Database\Factories\CostomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;


class Costomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'cpf'
    ];

    /**
    * Create a new factory instance for the model.
    */
    protected static function newFactory(): Factory
    {
        return CostomerFactory::new();
    }
}

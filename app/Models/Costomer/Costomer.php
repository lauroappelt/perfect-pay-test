<?php

namespace App\Models\Costomer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'cpf'
    ];
}

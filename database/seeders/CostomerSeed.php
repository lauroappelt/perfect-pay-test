<?php

namespace Database\Seeders;

use App\Models\Costomer\Costomer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CostomerSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Costomer::factory(100)->create();
    }
}

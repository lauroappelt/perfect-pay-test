<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'id' => Uuid::uuid4(),
            'name' => 'Lauro Appelt',
            'email' => 'lauro.appelt@mycompany.com',
            'password' => Hash::make('senhaforte'),
        ]);

        $this->call([
            CostomerSeed::class,
        ]);
    }
}

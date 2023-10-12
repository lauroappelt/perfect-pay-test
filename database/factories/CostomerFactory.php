<?php

namespace Database\Factories;

use App\Models\Costomer\Costomer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CostomerFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var class-string<\Illuminate\Database\Eloquent\Model>
    */
    protected $model = Costomer::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Uuid::uuid4(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => fake('pt_BR')->cpf(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var class-string<\Illuminate\Database\Eloquent\Model>
    */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Uuid::uuid4(),
            'name' => fake()->text('50'),
            'description' => fake()->text(),
            'price' => fake()->randomNumber(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\Sale\SaleEnum;
use App\Models\Costomer\Costomer;
use App\Models\Product\Product;
use App\Models\Sale\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SaleFactory extends Factory
{   
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $costomer = Costomer::factory()->create();
        $product = Product::factory()->create();

        return [
            'id' => Uuid::uuid4(),
            'costomer_id' => $costomer->id,
            'product_id' => $product->id,
            'date' => now()->format('Y-m-d'),
            'ammount' => fake()->numberBetween(1, 20),
            'discount' => fake()->numberBetween(1, 100),
            'status' => SaleEnum::WaitingPayment,
        ];
    }
}

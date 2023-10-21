<?php

namespace Tests\Feature\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ListProductTest extends TestCase
{
    public function can_list_products(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('api.product.list'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price'
                ]
            ]
        ]);
    }
}

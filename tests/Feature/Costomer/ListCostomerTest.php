<?php

namespace Tests\Feature\Costomer;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListCostomerTest extends TestCase
{
    public function test_list_costomers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('api.costomer.list'));

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'cpf'
                ]
            ]
        ]);
    }
}

<?php

namespace Tests\Feature\Costomer;

use App\Models\Costomer\Costomer;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class UpdateCostomerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }


    public function test_can_update_costomer(): void
    {
        $costomer = Costomer::factory()->create();
        $costomer->name .= ' updated';

        $reponse = $this->actingAs($this->user)->put(route('api.costomer.update', ['id' => $costomer->id]), $costomer->toArray(), ['Accept' => 'application/json']);

        $reponse->assertOk();

        $reponse->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'name',
                'email',
                'cpf',
            ]
        ]);

        $json = $reponse->json();

        $this->assertEquals($costomer->name, $json['data']['name']);
    }

    public function test_cannot_update_costomer_if_dooes_not_exists(): void
    {
        $costomer = Costomer::factory()->make();
        $costomer->id = Uuid::uuid4();

        $response = $this->actingAs($this->user)->put(route('api.costomer.update', ['id' => $costomer->id]), $costomer->toArray(), ['Accept' =>'application/json']);

        $response->assertNotFound();
    }

    public function test_cannot_update_to_invalid_email(): void
    {
        $costomer = Costomer::factory()->create();
        $costomer->email = 'invalid';

        $response = $this->actingAs($this->user)->put(route('api.costomer.update', ['id' => $costomer->id]), $costomer->toArray(), ['Accept' => 'application/json']);

        $response->assertUnprocessable();
    }
}

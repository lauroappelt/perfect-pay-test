<?php

namespace Tests\Feature\Feature\Costumer;

use Tests\TestCase;
use App\Models\User;

class CreateCostomerTest extends TestCase
{
    private $user;
    private $payload;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $faker = \Faker\Factory::create('pt_BR');
        $this->payload = [
            'name' => $faker->name(),
            'email' => $faker->email,
            'cpf' => $faker->cpf,
        ];
    }

    public function test_create_costomer(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('api.costomer'), $this->payload, [
                'Accept' => 'application/json',
            ]);

        $response->assertCreated();

        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'name',
                'email',
                'cpf'
            ],
        ]);

        $response->assertHeader('Location');
    }

    public function test_cannot_create_same_fields(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('api.costomer'), $this->payload, [
                'Accept' => 'application/json',
            ]);

        $response->assertCreated();

        $response = $this->actingAs($this->user)
            ->post(route('api.costomer'), $this->payload, [
                'Accept' => 'application/json',
            ]);

        $response->assertUnprocessable();
    }

    public function test_cannot_create_costomer_without_required_fields(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('api.costomer'), [], [
                'Accept' => 'application/json',
            ]);

        $response->assertUnprocessable();
    }

    public function test_cannot_create_costomer_with_invalid_email(): void
    {
        $payload = $this->payload;
        $payload['email'] = 'invalidmail';

        $response = $this->actingAs($this->user)
            ->post(route('api.costomer'), $payload, [
                'Accept' => 'application/json'
        ]);

        $response->assertUnprocessable();
    }

    public function test_cannot_create_costomer_with_invalid_cpf(): void
    {
        $payload = $this->payload;
        $payload['cpf'] = '111.111.111-11';

        $response = $this->actingAs($this->user)
            ->post(route('api.costomer'), $payload, [
                'Accept' => 'application/json'
        ]);

        $response->assertUnprocessable();
    }
}

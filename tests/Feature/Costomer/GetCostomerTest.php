<?php

namespace Tests\Feature\Costomer;

use App\Models\Costomer\Costomer;
use Tests\TestCase;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class GetCostomerTest extends TestCase
{
    private $user;
    
    public function setUp(): void
    {   
        parent::setUp();
        
        $this->user = User::factory()->create();
    }

    public function test_can_get_costomer(): void
    {
        $costomer = Costomer::factory()->create();

        $response = $this->actingAs($this->user)->get(route('api.costomer.get', ['id' => $costomer->id]));

        $response->assertOk();

        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'name',
                'email',
                'cpf'
            ]
        ]);
    }

    public function test_cannot_get_non_existing_costomer(): void
    {
        $response = $this->actingAs($this->user)->get(route('api.costomer.get', ['id' => Uuid::uuid4()]));

        $response->assertNotFound();
    }
}

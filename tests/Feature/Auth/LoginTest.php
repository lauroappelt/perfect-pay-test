<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_can_login(): void
    {   
        $password = fake()->password();
        $user = User::factory()->create([
            'id' => Uuid::uuid4(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => $password,
        ]);

        $response = $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => $password
        ], ['Accept' => 'application/json']);

        $response->assertOk();

        $response->assertJsonStructure([
            'access_token',
            'token_type',
        ]);
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $password = fake()->password();
        $user = User::factory()->create([
            'id' => Uuid::uuid4(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => $password,
        ]);

        $response = $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => $password . rand(),
        ], ['Accept' => 'application/json']);

        $response->assertUnauthorized();
    }

    public function test_user_cannot_login_without_password(): void
    {
        $password = fake()->password();
        $user = User::factory()->create([
            'id' => Uuid::uuid4(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => $password,
        ]);

        $response = $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => null,
        ], ['Accept' => 'application/json']);

        $response->assertUnprocessable();
    }

    public function test_user_cannot_login_with_invalid_email()
    {
        $password = fake()->password();
        $user = User::factory()->create([
            'id' => Uuid::uuid4(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => $password,
        ]);

        $response = $this->post(route('api.login'), [
            'email' => 'saDASDASD',
            'password' => $password,
        ], ['Accept' => 'application/json']);

        $response->assertUnprocessable();
    }
}

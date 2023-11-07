<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_database(): void
    {
        User::factory()->count(3)->create();
        $this->assertDatabaseCount('users', 6);
        $this->assertDatabaseHas('users', [
            'email' => 'aaa@gmail.com',
        ]);
        $this->assertDatabaseMissing('users', [
            'email' => 'sally@example.com',
        ]);
    }
}

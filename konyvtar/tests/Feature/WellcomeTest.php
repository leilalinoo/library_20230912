<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WellcomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSee(): void
    {
        $wanted = "Laravel";
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee($wanted);
    }

    public function testDontSee(): void
    {
        $wanted = "can i get a HOOOOOWYEEEAAAAHH";
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertDontSee($wanted, false);
    }
}

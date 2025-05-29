<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_show(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_store(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_update(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_destroy(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}

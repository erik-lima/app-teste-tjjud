<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutorControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a listagem de autores (GET /api/v1/autores)
     */
    public function test_index(): void
    {
        $autor1 = \App\Models\Autor::factory()->create();
        $autor2 = \App\Models\Autor::factory()->create();

        $response = $this->getJson('/api/v1/autores');

        $response->assertStatus(200)
                    ->assertJsonPath('error', false);
    }

    /**
     * Testa a exibição de um autor específico (GET /api/v1/autores/{cod})
     */
    public function test_show(): void
    {
        $autor = \App\Models\Autor::factory()->create();

        $response = $this->getJson("/api/v1/autores/{$autor->cod}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['cod' => $autor->cod]);
    }

    /**
     * Testa a criação de um autor (POST /api/v1/autores)
     */
    public function test_store(): void
    {
        $data = [
            'nome' => 'Autor de Teste',
        ];

        $response = $this->postJson('/api/v1/autores', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Autor de Teste']);

        $this->assertDatabaseHas('autores', ['nome' => 'Autor de Teste']);
    }

    public function test_store_empty_nome(): void
    {
        $data = [
            'nome' => '',
        ];

        $response = $this->postJson('/api/v1/autores', $data);

        $response->assertStatus(422);
    }

    /**
     * Testa a atualização de um autor (PUT /api/v1/autores/{cod})
     */
    public function test_update(): void
    {
        $autor = \App\Models\Autor::factory()->create();

        $data = [
            'nome' => 'Autor Atualizado',
        ];

        $response = $this->putJson("/api/v1/autores/{$autor->cod}", $data);

        $response->assertStatus(200)
                    ->assertJsonFragment(['data' => true]);

        $this->assertDatabaseHas('autores', ['cod' => $autor->cod, 'nome' => 'Autor Atualizado']);
    }

    /**
     * Testa a exclusão de um autor (DELETE /api/v1/autores/{cod})
     */
    public function test_destroy(): void
    {
        $autor = \App\Models\Autor::factory()->create();

        $response = $this->deleteJson("/api/v1/autores/{$autor->cod}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('autores', ['cod' => $autor->cod]);
    }
}

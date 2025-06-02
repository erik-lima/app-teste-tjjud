<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssuntoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação de um assunto (POST /api/v1/assuntos)
     */
    public function test_store(): void
    {
        $data = [
            'descricao' => 'Assunto de Teste',
        ];

        $response = $this->postJson('/api/v1/assuntos', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['descricao' => 'Assunto de Teste']);

        $this->assertDatabaseHas('assuntos', ['descricao' => 'Assunto de Teste']);
    }

    public function test_store_empty_descricao(): void
    {
        $data = [
            'descricao' => '',
        ];

        $response = $this->postJson('/api/v1/assuntos', $data);

        $response->assertStatus(422);
    }

    /**
     * Testa a listagem de assuntos (GET /api/v1/assuntos)
     */
    public function test_index(): void
    {
        // $assunto1 = \App\Models\Assunto::factory()->create();
        // $assunto2 = \App\Models\Assunto::factory()->create();

        $response = $this->get('/api/v1/assuntos');

        $response->assertStatus(200)
                    ->assertJsonPath('error', false);
    }

    /**
     * Testa a exibição de um assunto específico (GET /api/v1/assuntos/{cod})
     */
    public function test_show(): void
    {
        $assunto = \App\Models\Assunto::factory()->create();

        $response = $this->getJson("/api/v1/assuntos/{$assunto->cod}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['cod' => $assunto->cod]);
    }

    /**
     * Testa a atualização de um assunto (PUT /api/v1/assuntos/{cod})
     */
    public function test_update(): void
    {
        $assunto = \App\Models\Assunto::factory()->create();

        $data = [
            'descricao' => 'Assunto Atualizado',
        ];

        $response = $this->putJson("/api/v1/assuntos/{$assunto->cod}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['data' => true]);

        $this->assertDatabaseHas('assuntos', ['cod' => $assunto->cod, 'descricao' => 'Assunto Atualizado']);
    }

    /**
     * Testa a exclusão de um assunto (DELETE /api/v1/assuntos/{cod})
     */
    public function test_destroy(): void
    {
        $assunto = \App\Models\Assunto::factory()->create();

        $response = $this->deleteJson("/api/v1/assuntos/{$assunto->cod}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('assuntos', ['cod' => $assunto->cod]);
    }
}

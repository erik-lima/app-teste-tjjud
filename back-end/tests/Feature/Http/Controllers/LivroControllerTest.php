<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a listagem de livros (GET /api/v1/livros)
     */
    public function test_index(): void
    {
        $assunto1 = \App\Models\Assunto::factory()->create();
        $autor1 = \App\Models\Autor::factory()->create();
        $livro1 = \App\Models\Livro::factory()->create();

        \App\Models\LivroAssunto::create([
            'cod_as' => $assunto1->cod,
            'cod_li' => $livro1->cod
        ]);

        \App\Models\LivroAutor::create([
            'cod_au' => $autor1->cod,
            'cod_li' => $livro1->cod
        ]);


        $assunto2 = \App\Models\Assunto::factory()->create();
        $autor2 = \App\Models\Autor::factory()->create();
        $livro2 = \App\Models\Livro::factory()->create();

        \App\Models\LivroAssunto::create([
            'cod_as' => $assunto2->cod,
            'cod_li' => $livro2->cod
        ]);

        \App\Models\LivroAutor::create([
            'cod_au' => $autor2->cod,
            'cod_li' => $livro2->cod
        ]);

        $response = $this->getJson('/api/v1/livros');

        $response->assertStatus(200)
                    ->assertJsonPath('error', false);
    }

    /**
     * Testa a exibição de um livro específico (GET /api/v1/livros/{id})
     */
    public function test_show(): void
    {
        $livro = \App\Models\Livro::factory()->create();

        $response = $this->getJson("/api/v1/livros/{$livro->cod}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['cod' => $livro->cod]);
    }


    public function test_store_empty_titulo(): void
    {
        $data = [
            'titulo' => '',
            'editora' => 'Editora teste',
            'edicao' => '1',
            'ano_publicacao' => '2025',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_empty_editora(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => '',
            'edicao' => '1',
            'ano_publicacao' => '2025',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_empty_edicao(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => '',
            'ano_publicacao' => '2025',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_edicao_max(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => '150',
            'ano_publicacao' => '2025',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_edicao_min(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => -1,
            'ano_publicacao' => '2025',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_empty_ano_publicacao(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => 2,
            'ano_publicacao' => '',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_ano_publicacao_min(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => 2,
            'ano_publicacao' => '1200',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_ano_publicacao_max(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => 2,
            'ano_publicacao' => '10000',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_empty_valor(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => 2,
            'ano_publicacao' => '',
            'valor' => '5000',
            'autores' => ['1'],
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    public function test_store_empty_autores(): void
    {
        $data = [
            'titulo' => 'Titulo teste',
            'editora' => 'Editora Teste',
            'edicao' => 2,
            'ano_publicacao' => '',
            'valor' => '5000',
            'assuntos' => ['1'],
        ];

        $response = $this->postJson('/api/v1/livros', $data);
        $response->assertStatus(422);
    }

    /**
     * Testa a criação de um livro (POST /api/v1/livros)
     */
    public function test_store(): void
    {
        $data = \App\Models\Livro::factory()->make()->toArray();
        $assunto1 = \App\Models\Assunto::factory()->create();
        $autor1 = \App\Models\Autor::factory()->create();

        $data['autores'] = [$autor1];
        $data['assuntos'] = [$assunto1];


        $response = $this->postJson('/api/v1/livros', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['titulo' => $data['titulo']]);

        $this->assertDatabaseHas('livros', ['titulo' => $data['titulo']]);
    }

    /**
     * Testa a atualização de um livro (PUT /api/v1/livros/{id})
     */
    public function test_update(): void
    {
        $data = \App\Models\Livro::factory()->create();
        $livro = $data->toArray();
        $assunto1 = \App\Models\Assunto::factory()->create();
        $autor1 = \App\Models\Autor::factory()->create();

        $livro['autores'] = [$autor1];
        $livro['assuntos'] = [$assunto1];

        $livro['titulo'] = 'Livro Atualizado';

        $response = $this->putJson("/api/v1/livros/{$livro['cod']}", $livro);

        $response->assertStatus(200)
                 ->assertJsonFragment(['data' => true]);

        $this->assertDatabaseHas('livros', ['cod' => $livro['cod'], 'titulo' => 'Livro Atualizado']);
    }

    /**
     * Testa a exclusão de um livro (DELETE /api/v1/livros/{id})
     */
    public function test_destroy(): void
    {
        $livro = \App\Models\Livro::factory()->create();

        $response = $this->deleteJson("/api/v1/livros/{$livro->cod}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('livros', ['cod' => $livro->cod]);
    }
}

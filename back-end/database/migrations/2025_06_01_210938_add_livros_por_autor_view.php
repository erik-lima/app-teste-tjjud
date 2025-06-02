<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::statement("
            CREATE VIEW livros_por_autor 
            AS
            SELECT 
                au.cod as cod_autor,
                au.nome,
                li.cod AS cod_livro,
                li.titulo,
                li.editora,
                li.edicao,
                li.ano_publicacao,
                li.valor,
                GROUP_CONCAT(DISTINCT ass.descricao SEPARATOR ', ') AS assuntos,
                (
                    SELECT GROUP_CONCAT(DISTINCT a.nome SEPARATOR ', ')
                    FROM livro_autores la_sub
                    JOIN autores a ON a.cod = la_sub.cod_au
                    WHERE la_sub.cod_li = li.cod
                ) AS autores
            FROM
                autores au
            JOIN livro_autores la ON la.cod_au = au.cod
            JOIN livros li ON la.cod_li = li.cod
            JOIN livro_assuntos la2 ON la2.cod_li = li.cod
            JOIN assuntos ass ON ass.cod = la2.cod_as
            GROUP BY au.cod, li.cod
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

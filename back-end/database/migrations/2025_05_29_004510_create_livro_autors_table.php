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
        Schema::create('livro_autores', function (Blueprint $table) {
            $table->unsignedInteger('cod_au')->index();
            $table->unsignedInteger('cod_li')->index();

            $table->foreign('cod_au')->references('cod')->on('autores');
            $table->foreign('cod_li')->references('cod')->on('livros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_autors');
    }
};

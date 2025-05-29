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
        Schema::create('livro_assuntos', function (Blueprint $table) {
            $table->unsignedInteger('cod_as')->index();
            $table->unsignedInteger('cod_li')->index();

            $table->foreign('cod_as')->references('cod')->on('assuntos');
            $table->foreign('cod_li')->references('cod')->on('livros');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livro_assuntos');
    }
};

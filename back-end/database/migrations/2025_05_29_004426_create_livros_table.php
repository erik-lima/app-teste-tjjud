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
        Schema::create('livros', function (Blueprint $table) {
            $table->unsignedInteger('cod')->primary()->autoIncrement();
            $table->string('titulo', 40);
            $table->string('editora', 40);
            $table->integer('edicao');
            $table->unsignedInteger('valor');
            $table->string('ano_publicacao', 4);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};

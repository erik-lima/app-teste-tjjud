<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->name(),
            'editora' => $this->faker->name(),
            'edicao' => $this->faker->numberBetween(1, 99),
            'ano_publicacao' => $this->faker->year(),
            'valor' => $this->faker->numberBetween(5000, 250000),
        ];
    }
}

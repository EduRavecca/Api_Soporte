<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TareaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence,
            'contenido' => $this->faker->paragraph,
            'estado' => $this->faker->randomElement(['Por hacer', 'En curso', 'Finalizado']),
            'autor' => $this->faker->name,
        ];
    }
}

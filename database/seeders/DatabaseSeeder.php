<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Tarea::factory(10)->create();
        \App\Models\Tarea::factory(1)->create(
            [
                "titulo" => "Bucles PHP",
                "contenido" => "Capacitar sobre los bucles en PHP",
                "estado" => "En curso",
                "autor" => "Mateo",
            ]
        );
    }
}

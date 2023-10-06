<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tarea;

class TareaTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_InsertarTarea()
    {
        $response = $this -> post('/api/tareas',[
            "titulo" => "Escrito Programación",
            "contenido" => "Estudiar para el escrito",
            "estado" => "En proceso",
            "autor" => "Eduardo",
        ]);

        $response->assertStatus(201);

        $response->assertJsonCount(7);

        $this->assertDatabaseHas('tareas', [
            "titulo" => "Escrito Programación",
            "contenido" => "Estudiar para el escrito",
            "estado" => "En proceso",
            "autor" => "Eduardo",
        ]);

    }

    public function test_InsertarTareaConErrores()
    {
        $response = $this -> post('/api/tareas',[
            "contenido" => "Estudiar para el escrito",
            "estado" => "En proceso",
            "autor" => "Eduardo",
        ]);

        $response->assertStatus(403);

    }
}

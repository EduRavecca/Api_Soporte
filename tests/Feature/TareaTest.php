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
        $response = $this -> post('/api/tarea',[
            "titulo" => "Escrito Programación",
            "contenido" => "Estudiar para el escrito",
            "estado" => "Finalizado",
            "autor" => "Juan",
        ]);

        $response->assertStatus(201);

        $response->assertJsonCount(7);

        $this->assertDatabaseHas('tarea', [
            "titulo" => "Escrito Programación",
            "contenido" => "Estudiar para el escrito",
            "estado" => "Finalizado",
            "autor" => "Juan",
        ]);

    }

    public function test_InsertarTareaConErrores()
    {
        $response = $this -> post('/api/tarea',[
            "contenido" => "Estudiar para el escrito",
            "estado" => "Finalizado",
            "autor" => "Juan",
        ]);

        $response->assertStatus(403);

    }
}

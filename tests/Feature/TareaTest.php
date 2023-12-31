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

    public function test_ListarTareas()
    {
        $response = $this -> get('/api/tarea');

        $response->assertStatus(200);

        $response->assertJsonStructure([
                 [
                    'id',
                    'titulo',
                    'contenido',
                    'estado',
                    'autor',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ]
        ]);
    }

    public function test_ListarTareaExistente()
    {
        $estructura = [
            'id',
            'titulo',
            'contenido',
            'estado',
            'autor',
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        $response = $this -> get('/api/tarea/1');

        $response->assertStatus(200);

        $response->assertJsonCount(8);

        $response->assertJsonStructure($estructura);
    }

    public function test_ListarTareaInexistente()
    {
        $response = $this -> get('api/tarea/98992');

        $response->assertStatus(404);
    }

    public function test_ModificarTareaExistente()
    {
        $estructura = [
            'id',
            'titulo',
            'contenido',
            'estado',
            'autor',
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        $response = $this -> put('/api/tarea/1',[
            "titulo" => "Entrega Final",
            "contenido" => "Entregar en fecha y forma todo lo requerido",
            "estado" => "Por hacer",
            "autor" => "Eduardo",
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure($estructura);

        $response->assertJsonFragment([
            "titulo" => "Entrega Final",
            "contenido" => "Entregar en fecha y forma todo lo requerido",
            "estado" => "Por hacer",
            "autor" => "Eduardo",
        ]);
    }

    public function test_ModificarTareaInexistente()
    {
        $response = $this -> put('/api/tarea/25421',[

        ]);

        $response->assertStatus(404);

    }

    public function test_EliminarTareaExistente()
    {
        $response = $this -> delete('/api/tarea/1');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "mensaje" => "La tarea con ID 1 ha sido eliminada correctamente"
        ]);

       $this->assertDatabaseMissing('tarea', [
        'id' => '1',
        'deleted_at' => null
        ]);

        Tarea::withTrashed()->where("id",1)->restore();
    }

    public function test_EliminarTareaInexistente()
    {
        $response = $this -> delete('/api/tareas/87432');

        $response->assertStatus(404);
    }

    public function test_BuscarPorTituloExistente()
    {
        $response = $this->get('/api/tarea/titulo/Bucles PHP');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'titulo' => 'Bucles PHP',
        ]);
    }

    public function test_BuscarPorEstadoExistente()
    {
        $response = $this->get('/api/tarea/estado/En curso');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'estado' => 'En curso',
        ]);
    }

    public function test_BuscarPorAutorExistente()
    {
        $response = $this->get('/api/tarea/autor/Mateo');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'autor' => 'Mateo',
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function ListarTareas(Request $request)
    {
        return Tarea::all();
    }

    public function ListarUnaTarea(Request $request, $id)
    {
        return Tarea::findOrFail($id);
    }

    public function InsertarTarea(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'titulo' => 'required|max:255',
            'contenido' => 'nullable',
            'estado' => 'required|max:50',
            'autor' => 'required|max:100',
        ]);

        if ($validation->fails())
            return response($validation->errors(), 403);

        $tarea = new Tarea();

        $tarea->titulo = $request->post('titulo');
        $tarea->contenido = $request->post('contenido');
        $tarea->estado = $request->post('estado');
        $tarea->autor = $request->post('autor');

        $tarea->save();

        return $tarea;
    }

    public function EliminarTarea(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $tarea->delete();

        return [
            "mensaje" => "La tarea con id $id ha sido eliminada correctamente"
        ];
    }

    public function ModificarTarea(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'titulo' => 'required|max:255',
            'contenido' => 'nullable',
            'estado' => 'required|max:50',
            'autor' => 'required|max:100',
        ]);

        if ($validation->fails())
            return response($validation->errors(), 403);

        $tarea->update($request->all());

        $tarea->save();

        return $tarea;

    }

}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tarea', [TareaController::class,'InsertarTarea']);
Route::get('/tarea', [TareaController::class,'ListarTareas']);
Route::get('/tarea/{id}', [TareaController::class,'ListarUnaTarea']);
Route::put('/tarea/{id}', [TareaController::class,'ModificarTarea']);
Route::delete('/tarea/{id}', [TareaController::class,'EliminarTarea']);
Route::get('/tarea/titulo/{titulo}', [TareaController::class, 'BuscarPorTitulo']);
Route::get('/tarea/autor/{autor}', [TareaController::class, 'BuscarPorAutor']);
Route::get('/tarea/estado/{estado}', [TareaController::class, 'BuscarPorEstado']);

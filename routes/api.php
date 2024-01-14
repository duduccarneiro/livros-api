<?php

use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LivroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('autores', [AutorController::class, 'index']);
Route::post('autores', [AutorController::class, 'store']);
Route::get('autores/{autor}', [AutorController::class, 'get']);
Route::patch('autores/{autor}', [AutorController::class, 'update']);
Route::delete('autores/{id}', [AutorController::class, 'destroy']);

Route::get('assuntos', [AssuntoController::class, 'index']);
Route::post('assuntos', [AssuntoController::class, 'store']);
Route::get('assuntos/{assunto}', [AssuntoController::class, 'get']);
Route::patch('assuntos/{assunto}', [AssuntoController::class, 'update']);
Route::delete('assuntos/{id}', [AssuntoController::class, 'destroy']);

Route::get('livros', [LivroController::class, 'index']);
Route::post('livros', [LivroController::class, 'store']);
Route::get('livros/relatorio', [LivroController::class, 'getRelatorioLivrosPorAutor']);
Route::get('livros/{livro}', [LivroController::class, 'get']);
Route::patch('livros/{livro}', [LivroController::class, 'update']);
Route::delete('livros/{id}', [LivroController::class, 'destroy']);

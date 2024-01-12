<?php

use App\Models\Autor;
use App\Models\Livro;
use App\Models\Assunto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $autor = Autor::create(['Nome' => 'Eduardo']);
    $autor2 = Autor::create(['Nome' => 'Jamile']);

    $livro = Livro::create([
        'Titulo' => 'Livro 2',
        'Editora' => 'Editora 1',
        'Edicao' => '4',
        'AnoPublicacao' => '2022'
    ]);

    $livro->autores()->attach([$autor->CodAu, $autor2->CodAu]);

    $assunto1 = Assunto::create(['Descricao' => 'Culinaria']);
    $assunto2 = Assunto::create(['Descricao' => 'Alimentação']);
    $assunto3 = Assunto::create(['Descricao' => 'Nutrientes']);

    $livro->assuntos()->attach([$assunto1->CodAs, $assunto2->CodAs, $assunto3->CodAs]);

    dd(Livro::all());
    return view('welcome');
});

Route::get('/livros', [LivroController::class, 'index']);
Route::get('/livros/novo', [LivroController::class, 'create']);
Route::post('/livros', [LivroController::class, 'store']);

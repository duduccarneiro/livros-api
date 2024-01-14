<?php

use App\Models\Autor;
use App\Models\Livro;
use App\Models\Assunto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;

use Barryvdh\DomPDF\Facade\Pdf;

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
    return view('welcome');
});
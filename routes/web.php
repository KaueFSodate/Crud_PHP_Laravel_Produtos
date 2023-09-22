<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;

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

Route::get('/api', function () {
    return view('TemplateAdmin.index');
});

Route::group(['prefix' => 'marca'], function () {
    Route::get('/', [MarcaController::class, 'index']);
    Route::get('/inserir', [MarcaController::class, 'inserir']);
    Route::get('/alterar', [MarcaController::class, 'alterar']);
    Route::get('/excluir', [MarcaController::class, 'excluir']);
});

Route::group(['prefix' => 'categoria'], function () {
    Route::get('/', [CategoriaController::class, 'index']);
    Route::get('/inserir', [CategoriaController::class, 'inserir']);
    Route::get('/alterar', [CategoriaController::class, 'alterar']);
    Route::get('/excluir', [CategoriaController::class, 'excluir']);
});

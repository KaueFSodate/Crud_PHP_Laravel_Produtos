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
    Route::get('/', [MarcaController::class, 'index'])->name('marca.index');;
    Route::get('/inserir', [MarcaController::class, 'inserir']);
    Route::post('/inserir', [MarcaController::class, 'inserirSubmit'])->name('marca.inserir.submit');
    Route::get('/alterar/{id}', [MarcaController::class, 'alterar']);
    Route::put('/alterar/{id}', [MarcaController::class, 'alterarMarca'])->name('marca.alterar');
    Route::delete('/excluir/{id}', [MarcaController::class, 'excluir'])->name('marca.excluir');;
});

Route::group(['prefix' => 'categoria'], function () {
    Route::get('/', [CategoriaController::class, 'index']);
    Route::get('/inserir', [CategoriaController::class, 'inserir']);
    Route::get('/alterar', [CategoriaController::class, 'alterar']);
    Route::get('/excluir', [CategoriaController::class, 'excluir']);
});

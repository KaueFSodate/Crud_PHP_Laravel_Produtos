<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CorController;

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
    Route::get('/', [CategoriaController::class, 'index'])->name('categoria.index');;
    Route::get('/inserir', [CategoriaController::class, 'inserir']);
    Route::post('/inserir', [CategoriaController::class, 'inserirSubmit'])->name('categoria.inserir.submit');
    Route::get('/alterar/{id}', [CategoriaController::class, 'alterar']);
    Route::put('/alterar/{id}', [CategoriaController::class, 'alterarCategoria'])->name('categoria.alterar');
    Route::delete('/excluir/{id}', [CategoriaController::class, 'excluir'])->name('categoria.excluir');
});

Route::group(['prefix' => 'cor'], function () {
    Route::get('/', [CorController::class, 'index'])->name('cor.index');;
    Route::get('/inserir', [CorController::class, 'inserir']);
    Route::post('/inserir', [CorController::class, 'inserirSubmit'])->name('cor.inserir.submit');
    Route::get('/alterar/{id}', [CorController::class, 'alterar']);
    Route::put('/alterar/{id}', [CorController::class, 'alterarCor'])->name('cor.alterar');
    Route::delete('/excluir/{id}', [CorController::class, 'excluir'])->name('cor.excluir');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;

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

Route::group(['prefix' => 'admin'], function(){
    Route::group(['prefix' => 'marca'], function () {
        Route::get('/', [MarcaController::class, 'index'])->name('marca.index');;
        Route::get('/inserir', [MarcaController::class, 'inserir']);
        Route::post('/inserir', [MarcaController::class, 'inserirSubmit'])->name('marca.inserir.submit');
        Route::get('/alterar/{id}', [MarcaController::class, 'alterar']);
        Route::post('/alterar/{id}', [MarcaController::class, 'alterarMarca'])->name('marca.alterar');
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

    Route::group(['prefix' => 'produto'], function () {
        Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');;
        Route::get('/inserir', [ProdutoController::class, 'inserir']);
        Route::get('/comprasUsuarios', [ProdutoController::class, 'indexComprasUsuarios']);
        Route::post('/inserir', [ProdutoController::class, 'inserirSubmit'])->name('produto.inserir.submit');
        Route::get('/alterar/{id}', [ProdutoController::class, 'alterar']);
        Route::post('/alterar/{id}', [ProdutoController::class, 'alterarProduto'])->name('produto.alterar');
        Route::delete('/excluir/{id}', [ProdutoController::class, 'excluir'])->name('produto.excluir');

    });

    Route::group(['prefix' => 'cor'], function () {
        Route::get('/', [CorController::class, 'index'])->name('cor.index');;
        Route::get('/inserir', [CorController::class, 'inserir']);
        Route::post('/inserir', [CorController::class, 'inserirSubmit'])->name('cor.inserir.submit');
        Route::get('/alterar/{id}', [CorController::class, 'alterar']);
        Route::put('/alterar/{id}', [CorController::class, 'alterarCor'])->name('cor.alterar');
        Route::delete('/excluir/{id}', [CorController::class, 'excluir'])->name('cor.excluir');
    });

});
Route::group(['prefix' => 'users'], function(){
    Route::group(['prefix' => 'indexProdutos'], function () {
        Route::get('/', [CarrinhoController::class, 'index'])->name('carrinho.index');;
        Route::get('/infoProdutos/{id}', [CarrinhoController::class, 'detalhesProduto'])->name('produto.detalhes');
        Route::post('/adicionarAoCarrinho/{id}', [CarrinhoController::class, 'adicionarAoCarrinho'])->name('produto.adicionarAoCarrinho');
        Route::get('/carrinho', [CarrinhoController::class, 'carrinho'])->name('Compras.carrinho');
        Route::post('/confirmarCompra', [CarrinhoController::class, 'confirmarCompra'])->name('carrinho.inserir');
        Route::post('/remover/{key}', [CarrinhoController::class, 'removerItem'])->name('carrinho.remover');
        Route::post('/limpar-carrinho', [CarrinhoController::class, 'limparCarrinho'])->name('carrinho.limpar');
    });
});




<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\ComprasUsuario;
use App\Models\Cor;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(){
        $produtos = Produto::all()->toArray();
        $marcas = Marca::all()->toArray();
        $cores = Cor::all()->toArray();
        $categorias = Categoria::all()->toArray();
        return view('Produto.index', [
            'listaProdutos' => $produtos,
            'listaMarcas' => $marcas,
            'listaCores' => $cores,
            'listaCategorias' => $categorias,
        ]);
    }

    public function indexComprasUsuarios(){
        $compras = ComprasUsuario::all();
        return view('Produto.compras', [
            'compras' => $compras
        ]);
    }
    public function inserir(){
        $marcas = Marca::all()->toArray();
        $cores = Cor::all()->toArray();
        $categorias = Categoria::all()->toArray();
        return view('Produto.inserir', [
            'listaMarcas' => $marcas,
            'listaCores' => $cores,
            'listaCategorias' => $categorias,
        ]);
    }
    public function inserirSubmit(Request $request){

        $produto = new Produto();
        $produto->nome = $request->input('nome');
        $produto->categoria = $request->input('categoria');
        $produto->marca = $request->input('marca');
        $produto->preco = $request->input('preco');
        $produto->quantidade = $request->input('quantidade');
        $produto->quantidade_solic = 0;
        $produto->cor = $request->input('cor');
        $produto->url_img = $request->input('url_img');
        $produto->descricao = html_entity_decode(strip_tags($request->input('descricao')));
        $produto->save();

        return redirect()->route('produto.index')->with('success', 'Produto inserido com sucesso.');
    }

    public function excluir($id){
        $produto = Produto::find($id);
        if (!$produto) {
            return redirect()->route('produto.index')->with('error', 'Produto não encontrado.');
        }

        $produto->delete();

        return redirect()->route('produto.index')->with('success', 'Produto excluido com sucesso.');
    }
    public function alterar($id){
        $produto = Produto::find($id);
        if (!$produto) {
            return redirect()->route('produto.index')->with('error', 'Produto não encontrado.');
        }

        $cor = Cor::find($produto['cor']);
        $categoria = Categoria::find($produto['categoria']);
        $marca = Marca::find($produto['marca']);

        $marcas = Marca::all()->toArray();
        $cores = Cor::all()->toArray();
        $categorias = Categoria::all()->toArray();

        return view('Produto.inserir', [
            'produto' => $produto,
            'listaMarcas' => $marcas,
            'listaCores' => $cores,
            'listaCategorias' => $categorias,
            'categoria' => $categoria,
            'cor' => $cor,
            'marca' => $marca,
        ]);
    }

    public function alterarProduto(Request $request, $id){
        $produto = Produto::find($id);

        $produto->nome = $request->input('nome');
        $produto->categoria = $request->input('categoria');
        $produto->marca = $request->input('marca');
        $produto->preco = $request->input('preco');
        $produto->quantidade = $request->input('quantidade');
        $produto->cor = $request->input('cor');
        $produto->url_img = $request->input('url_img');
        $produto->descricao = html_entity_decode(strip_tags($request->input('descricao')));
        $produto->save();

        return redirect()->route('produto.index')->with('success', 'Produto editado com sucesso.');
    }
}

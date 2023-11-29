<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carrinho;
use App\Models\Categoria;
use App\Models\ComprasUsuario;
use App\Models\Cor;
use App\Models\Marca;
use App\Models\Produto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Session;
use function Sodium\add;

class CarrinhoController extends Controller
{

    public function index(Request $request)
    {
        $produtosQuery = Produto::query();

        if ($request->filled('categoria')) {
            $produtosQuery->where('categoria', $request->input('categoria'));
        }

        if ($request->filled('marca')) {
            $produtosQuery->where('marca', $request->input('marca'));
        }


        $produtos = $produtosQuery->get()->toArray();
        $marcas = Marca::all()->toArray();
        $cores = Cor::all()->toArray();
        $categorias = Categoria::all()->toArray();

        return view('Compras.VisualizacaoProdutos', [
            'listaProdutos' => $produtos,
            'listaMarcas' => $marcas,
            'listaCores' => $cores,
            'listaCategorias' => $categorias,
        ]);
    }

    public function detalhesProduto($id)
    {
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

        return view('Compras.infoProdutos', [
            'produto' => $produto,
            'listaMarcas' => $marcas,
            'listaCores' => $cores,
            'listaCategorias' => $categorias,
            'categoria' => $categoria,
            'cor' => $cor,
            'marca' => $marca,
        ]);
    }

    public function carrinho()
    {
        $carrinho = session('carrinho', []);

        $precoTotal = 0;
        $quantidadeTotal = 0;

        foreach ($carrinho as $produto) {
            $precoTotal += $produto['preco'] * $produto['quantidade_solic'];
            $quantidadeTotal += $produto['quantidade_solic'];
        }

        $listaEmails = Usuario::all()->toArray();

        return view('Compras.Carrinho', [
            'carrinho' => $carrinho,
            'precoTotal' => $precoTotal,
            'quantidadeTotal' => $quantidadeTotal,
            'listaEmails' => $listaEmails,
        ]);
    }

    public function adicionarAoCarrinho(Request $request, $id)
    {
        $produto = Produto::find($id);
        $quantidade = $request->input("quantidade");

        $produto['quantidade_solic'] = $quantidade;

        $carrinho = session('carrinho', []);
        $carrinho[] = $produto;

        session(['carrinho' => $carrinho]);

        $precoTotal = 0;
        $quantidadeTotal = 0;

        foreach ($carrinho as $produto) {
            $precoTotal += $produto['preco'] * $produto['quantidade_solic'];
            $quantidadeTotal += $produto['quantidade_solic'];
        }
        $listaEmails = Usuario::all()->toArray();

        return view('Compras.Carrinho', [
            'carrinho' => $carrinho,
            'precoTotal' => $precoTotal,
            'quantidadeTotal' => $quantidadeTotal,
            'listaEmails' => $listaEmails,
        ]);
    }


    public function confirmarCompra(Request $request)
    {

        $usuario = Usuario::select("id", "nome", "email")
            ->where("email", $request->input('email'))
            ->get();

        if ($usuario->isEmpty()) {
            return redirect()->route('Compras.carrinho')->with('error', 'E-mail inválido.');
        }
        $usuarioId = $usuario->first()->id;



        $produtosIds = $request->input('produtos');
        $produtos = Produto::whereIn('id', $produtosIds)->get();

        $carrinho = new Carrinho();
        $carrinho->usuario_id = $usuarioId ?? null;
        $carrinho->meio_pagamento = $request->input('meio_pagamento');
        $carrinho->preco_total = $request->input('preco_total');
        $carrinho->quantidade_total = $request->input('quantidade_total');
        $carrinho->save();
        $quantidadesSolic = $request->input('quantidade_solic');
        foreach ($produtos as $key => $produto) {
            $compraUsuario = new ComprasUsuario();
            $compraUsuario->usuarios  = $usuarioId;
            $produto->quantidade_solic = 0;
            $compraUsuario->produtos = $produto->id;
            $compraUsuario->carrinhos = $carrinho->id;
            $compraUsuario->quantidade_solic = $quantidadesSolic[$key] ?? 0;
            $compraUsuario->save();
        }
        session()->forget('carrinho');
        return redirect()->route('carrinho.index')->with('success', 'Compra realizada com sucesso.');
    }

    public function removerItem($key)
    {
        $carrinho = session()->get('carrinho', []);

        if (array_key_exists($key, $carrinho)) {
            unset($carrinho[$key]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()->route('Compras.carrinho')->with('success', 'Item removido do carrinho com sucesso.');
    }

    public function limparCarrinho(){
        session()->forget('carrinho');
        return redirect()->route('Compras.carrinho')->with('success', 'Carrinho limpo com sucesso.');
    }
}

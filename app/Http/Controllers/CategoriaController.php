<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(){
        $dados = Categoria::all()->toArray();
        return view('Categoria.index', [
            'listaCategorias' => $dados,
        ]);
    }
    public function inserir(){
        return view('Categoria.inserir');
    }

    public function excluir(){
        return view('Categoria.excluir');
    }
    public function alterar(){
        return view('Categoria.alterar');
    }
}

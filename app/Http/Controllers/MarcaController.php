<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function index(){
        $dados = Marca::all()->toArray();
        return view('Marca.index', [
            'listaMarcas' => $dados,
        ]);
    }
    public function inserir(){
        return view('Marca.inserir');
    }

    public function excluir(){
        return view('Marca.excluir');
    }
    public function alterar(){
        return view('Marca.alterar');
    }
}

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
        //Marca::created()->toArray();
        return view('Marca.inserir');
    }
    public function inserirSubmit(Request $request){
        $request->validate([
            'nome' => 'required',
            'nome_fantasia' => 'required',
            'situacao' => 'required',
        ]);

        $marca = new Marca();
        $marca->nome = $request->input('nome');
        $marca->nome_fantasia = $request->input('nome_fantasia');
        $marca->situacao = $request->input('situacao');
        $marca->save();

        return redirect()->route('marca.index')->with('success', 'Marca inserida com sucesso');
    }


    public function excluir(Request $request, $id){
        $marca = Marca::find($id);
        if (!$marca) {
            return redirect()->route('marca.index')->with('error', 'Marca não encontrada.');
        }

        $marca->delete();

        return redirect()->route('marca.index')->with('success', 'Marca excluida com sucesso');
    }
    public function alterar($id){
        $marca = Marca::find($id);

        if (!$marca) {
            return redirect()->route('marca.index')->with('error', 'Marca não encontrada.');
        }

        return view('Marca.alterar', compact('marca'));
    }

    public function alterarMarca(Request $request, $id){
        $request->validate([
            'nome' => 'required',
            'nome_fantasia' => 'required',
            'situacao' => 'required',
        ]);
        $marca = Marca::find($id);

        $marca->nome = $request->input('nome');
        $marca->nome_fantasia = $request->input('nome_fantasia');
        $marca->situacao = $request->input('situacao');
        $marca->save();

        return redirect()->route('marca.index')->with('success', 'Marca editada com sucesso');
    }
}
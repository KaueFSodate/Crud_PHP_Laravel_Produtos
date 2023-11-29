<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $dados = Usuario::all()->toArray();
        return view('Usuarios.index', [
            'listaUsuarios' => $dados,
        ]);
    }

    public function inserir()
    {
        return view('Usuarios.inserir');
    }

    public function inserirSubmit(Request $request)
    {

        $usuario = new Usuario();
        $usuario->nome = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuário inserido com sucesso.');
    }


    public function excluir(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return redirect()->route('usuario.index')->with('error', 'Usuário não encontrado.');
        }

        $usuario->delete();

        return redirect()->route('usuario.index')->with('success', 'Usuário excluido com sucesso.');
    }

    public function alterar($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return redirect()->route('usuario.index')->with('error', 'Usuário não encontrado.');
        }

        return view('Usuarios.inserir', compact('usuario'));
    }

    public function alterarUsuario(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        $usuario->nome = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->save();

        return redirect()->route('usuario.index')->with('success', 'Usuario editado com sucesso.');
    }
}

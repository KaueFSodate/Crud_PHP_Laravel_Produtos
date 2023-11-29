@extends('TemplateAdmin.index')

@section('contents')
    @php
        $titulo = "Inclusão de um novo Usuário";
        $endpoint = "/admin/usuario/inserir";
        $input_id = "";
        $input_name = "";
        $input_email = "";
        $method = "post";
        if(isset($usuario)){
            $input_id = $usuario['id'];
            $titulo = "Alteração do Usuário";
            $endpoint = "/admin/usuario/alterar/$input_id";
            $input_name = $usuario['nome'];
            $input_email = $usuario['email'];
            $method = "put";
        }
    @endphp
    <h1 class="h3 mb-4 text-gray-800">{{$titulo}}</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ $endpoint }}" method="post" style="display: flex; flex-direction: column">
                @csrf
                <input type="hidden" name="id" value="{{$input_id}}" style="margin: 0"/>
                <label>Nome do Usuário</label>
                <input type="text" name="nome" value="{{$input_name}}" style="margin-bottom: 10px" placeholder="Nome">
                <label>E-mail do Usuário</label>
                <input type="text" name="email" value="{{$input_email}}" style="margin-bottom: 10px" placeholder="E-mail">

                <div style="width: 100%; display: flex; justify-content: flex-end">
                    <button type="submit" class="btn btn-success" style="width: 10%">Inserir</button>
                </div>
            </form>
        </div>
    </div>
@endsection

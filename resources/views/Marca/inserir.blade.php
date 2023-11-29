@extends('TemplateAdmin.index')

@section('contents')
    @php
        $titulo = "Inclusão de uma nova Marca";
        $endpoint = "/admin/marca/inserir";
        $input_name = "";
        $input_fantasia = "";
        $input_id = "";
        $method = "post";
        if(isset($marca)){
            $input_id = $marca['id'];
            $titulo = "Alteração da Marca";
            $endpoint = "/admin/marca/alterar/$input_id";
            $input_name = $marca['nome'];
            $input_fantasia = $marca['nome_fantasia'];
            $method = "put";
        }
    @endphp
    <h1 class="h3 mb-4 text-gray-800">{{$titulo}}</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ $endpoint }}" method="post" style="display: flex; flex-direction: column">
                @csrf
                <input type="hidden" name="id" value="{{$input_id}}" style="margin: 0"/>
                <label>Nome da Marca</label>
                <input type="text" name="nome" value="{{$input_name}}" style="margin-bottom: 10px" placeholder="Nome">
                <label>Nome de Fantasia</label>
                <input type="text" name="nome_fantasia" value="{{$input_fantasia}}" style="margin-bottom: 10px" placeholder="Nome de Fantasia">
                <label>Situação</label>
                <select name="situacao" style="margin-bottom: 10px">
                    <option value="1" selected>Ativo</option>
                    <option value="0">Inativo</option>
                </select>
                <div style="width: 100%; display: flex; justify-content: flex-end">
                    <button type="submit" class="btn btn-success" style="width: 10%">Inserir</button>
                </div>
            </form>
        </div>
    </div>
@endsection

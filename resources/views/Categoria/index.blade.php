@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Categoria de Produtos</h1>

    <div class="card">
        <div class="card-body">
            <a href="/admin/categoria/inserir" class="btn btn-success" style="margin-bottom: 10px">Novo</a>
            <table class="table table-bordered dataTable">
                <thead>
                <td>ID</td>
                <td>Nome</td>
                <td>Situação</td>
                <td>Opções</td>
                </thead>
                <tbody>
                @foreach($listaCategorias as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['nome']}}</td>
                        <td>{{$item['situacao'] == 1 ? 'ATIVO' : 'INATIVO'}}</td>
                        <td>
                            <div style="display: flex; width: 100%">
                                <form style="margin-left: 20px"
                                      action="{{ route('categoria.alterar', ['id' => $item['id']]) }}" method="get">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-success">
                                        Alterar
                                    </button>
                                </form>
                                <form style="margin-left: 20px"
                                      action="{{ route('categoria.excluir', ['id' => $item['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@extends('TemplateAdmin.index')

@section('contents')
    @php
    use App\Models\Categoria;
    use App\Models\Cor;
    use App\Models\Marca;
    use App\Models\Produto;
 @endphp
    <h1 class="h3 mb-4 text-gray-800">Produtos</h1>

    <div class="card">
        <div class="card-body">
            <a href="/admin/produto/inserir" class="btn btn-success" style="margin-bottom: 10px">Novo</a>
            <table class="table table-bordered dataTable">
                <thead>
                <td>ID</td>
                <td>Nome</td>
                <td>Categoria</td>
                <td>Marca</td>
                <td>Cor</td>
                <td>Quantidade</td>
                <td>Preço</td>
                <td>Descrição</td>
                <td>Opções</td>
                </thead>
                <tbody>
                @foreach($listaProdutos as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['nome']}}</td>
                        <td>{{Categoria::find($item['categoria'])['nome']}}</td>
                        <td>{{Marca::find($item['marca'])['nome']}}</td>
                        <td>{{Cor::find($item['cor'])['cor']}}</td>
                        <td>{{$item['quantidade']}}</td>
                        <td>{{$item['preco']}}</td>
                        <td>{{$item['descricao']}}</td>
                        <td>
                            <div style="display: flex; width: 100%">
                                <form style="margin-left: 20px"
                                      action="{{ route('produto.alterar', ['id' => $item['id']]) }}" method="get">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn btn-success">
                                        Alterar
                                    </button>
                                </form>
                                <form style="margin-left: 20px"
                                      action="{{ route('produto.excluir', ['id' => $item['id']]) }}" method="POST">
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

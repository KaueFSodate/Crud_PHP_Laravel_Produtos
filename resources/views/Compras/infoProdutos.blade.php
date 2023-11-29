@extends('TemplateUsers.index')

@section('contents')
    <style>
        body {
            font-family: 'Roboto', sans-serif;

        }

        .card {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
        }

        .card-body {
            text-align: start;

        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Adicione outros estilos conforme necessário */

    </style>

    <div class="card">
        <div style="width: 100%;display: flex;justify-content: flex-start; margin: 5px">
            <a class="btn btn-primary" href="/users/indexProdutos" ><i class="fa fa-arrow-left"></i>Voltar</a>
        </div>
        <div class="card-body" >
            <div style="width: 100%; display: flex; justify-content: center">
                <img src="{{$produto['url_img']}}" style="width: 20%; height: 20%" />
            </div>
            <hr>
            <p>Nome: {{$produto['nome']}}</p>
            <hr>
            <p>Preço: {{$produto['preco']}}</p>
            <hr>
            <p>Descrição: {{$produto['descricao']}}</p>
            <form method="post" action="{{ route('produto.adicionarAoCarrinho', ['id' => $produto['id']]) }}">
                @csrf
                <label>Quantidade:</label>
                <input type="number" name="quantidade"/>
                <div style="display: flex; justify-content:flex-end; width: 100%">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


@extends('TemplateUsers.index')

@section('contents')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        p {
            font-size: 18px;
        }

        .filter-container {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            background-color: #f8f9fa; /* Cor de fundo suave */
            padding: 10px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            align-items: center;
        }

        .filter-group label {
            margin-right: 10px;
        }

        .filter-group input {
            margin-right: 10px;
        }

        .filter-group button {
            background-color: #007bff; /* Cor do botão */
            color: #fff; /* Cor do texto do botão */
        }

    </style>
    @php
        use App\Models\Categoria;
        use App\Models\Cor;
        use App\Models\Marca;
        use App\Models\Produto;
    @endphp

    <h1 class="h3 mb-4 text-gray-800">Produtos</h1>

    <div class="filter-container">
        <form style="display: flex" method="get" action="{{ route('carrinho.index') }}">
            <div class="filter-group" style="margin-right: 20px">
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" class="form-control">
                    <option value="">Todas as categorias</option>
                    @foreach($listaCategorias as $categoria)
                        <option value="{{ $categoria['id'] }}">{{ $categoria['nome'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group" style="margin-right: 20px">
                <label for="marca">Marca</label>
                <select id="marca" name="marca" class="form-control">
                    <option value="">Todas as marcas</option>
                    @foreach($listaMarcas as $marca)
                        <option value="{{ $marca['id'] }}">{{ $marca['nome'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i> Filtrar
            </button>
        </form>
    </div>
    <div class="card">
        <a href="/users/indexProdutos/carrinho" class="btn btn-success" style="margin-bottom: 10px; width: 20%; margin: 5px">Meu
            carrinho</a>
        <div class="row">
            @foreach($listaProdutos as $produto)
                <div class="col-md-3" style="margin-bottom: 20px;">
                    <a href="/users/indexProdutos/infoProdutos/{{$produto['id']}}" style="text-decoration: none">
                        <div
                            style="background-color: #1B4079; box-shadow: 2px 2px 6px #989C94; width: 100%; height:350px; display: flex; align-items: center;  flex-direction: column;  text-align: center;">
                            <img src="{{$produto['url_img']}}" style="width: 100%; height: 60%; margin-bottom: 20%"/>
                            <p style="font-weight: bold; color: azure; font-size: 18px;font-family: 'Roboto', sans-serif;">
                                Nome: {{ $produto['nome'] }}</p>
                            <p style="color: azure;font-size: 18px;font-family: 'Roboto', sans-serif;">
                                Preço: {{ $produto['preco'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

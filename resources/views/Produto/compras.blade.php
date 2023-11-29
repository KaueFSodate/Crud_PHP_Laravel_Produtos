@extends('TemplateAdmin.index')

@section('contents')
    @php
        use App\Models\Usuario;
        use App\Models\Carrinho;
        use App\Models\Produto;
        use App\Models\Categoria;
        use App\Models\Marca;
        use App\Models\Cor;
    @endphp

    <h1 class="h3 mb-4 text-gray-800">Compras usuários</h1>

    <div class="card">
        <div class="card-body">
            <div style="width: 100%;display: flex;justify-content: flex-start; margin: 5px">
                <a class="btn btn-primary" href="/admin/produto"><i class="fa fa-arrow-left"></i>Voltar</a>
            </div>

            @php
                $lastEmail = null;
                $lastCarrinho = null;
            @endphp

            @foreach($compras as $item)
                @php
                    $produto = Produto::find($item->produtos);
                    $categoria = Categoria::find($produto->categoria);
                    $marca = Marca::find($produto->marca);
                    $cor = Cor::find($produto->cor);
                    $usuario = Usuario::find($item->usuarios);
                    $carrinho = Carrinho::find($item->carrinhos);
                @endphp

                @if ($lastEmail !== $usuario->email || $lastCarrinho !== $item->carrinhos)
                    @if ($lastEmail !== null)
                        </tbody>
            </table>
            <hr>
            @endif

            <div class="mb-3">
                <p class="mb-1"><strong>Email:</strong> {{ $usuario->email }}</p>
                <p class="mb-1"><strong>Valor:</strong> R$ {{ number_format($carrinho->preco_total, 2, ',', '.') }}</p>
                <p class="mb-1"><strong>Quantidade total:</strong> {{ $carrinho->quantidade_total }}</p>
                <p class="mb-1"><strong>Meio Pagamento:</strong> {{ $carrinho->meio_pagamento }}</p>
            </div>
            <table class="table table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID Carrinho</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Marca</th>
                    <th>Cor</th>
                    <th>Quantidade solicitada</th>
                </tr>
                </thead>
                <tbody>
                @endif

                <tr>
                    <td>{{ $item->carrinhos }}</td>
                    <td>{{ $produto['nome']}}</td>
                    <td>{{ $produto['descricao']}}</td>
                    <td>{{ $categoria['nome']}}</td>
                    <td>{{ $marca['nome']}}</td>
                    <td>{{ $cor['cor']}}</td>
                    <td>{{ $item->quantidade_solic}}</td>
                </tr>

                @php
                    $lastEmail = $usuario->email;
                    $lastCarrinho = $item->carrinhos;
                @endphp
                @endforeach

                @if ($lastEmail !== null)
                </tbody>
            </table>
            <hr>
            @endif
        </div>
    </div>
@endsection

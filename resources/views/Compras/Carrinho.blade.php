@extends('TemplateUsers.index')

@section('contents')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('carrinhoForm');
            const emailInput = document.getElementById('emailInput');

            form.addEventListener('submit', function (event) {

                if (event.submitter && event.submitter.classList.contains('finalizar-compra')) {

                    if (emailInput.value.trim() === '') {
                        alert('Insira seu e-mail antes de finalizar a compra.');
                        event.preventDefault();
                    }
                }
            });
        });
    </script>
    <div class="card">
        <div style="width: 100%;display: flex;justify-content: flex-start; margin: 5px">
            <a class="btn btn-primary" href="/users/indexProdutos"><i class="fa fa-arrow-left"></i>Voltar</a>
        </div>
        <div class="card-body">
            <form id="carrinhoForm" action="{{ route('carrinho.inserir') }}" method="post">
                @csrf

                @if (isset($carrinho) && !empty($carrinho))
                    @foreach($carrinho as $key => $produto)
                        <div style="width: 100%; display: flex; justify-content: flex-end">
                            <button class="btn btn-danger" type="submit"
                                    formaction="{{ route('carrinho.remover', $key) }}" title="Remover item"><i
                                    class="fa fa-trash"></i>
                            </button>
                        </div>
                        <input type="hidden" name="produtos[]" value="{{$produto['id']}}">
                        <div style="width: 100%; display: flex; justify-content: center">
                            <img src="{{$produto['url_img']}}" style="width: 20%; height: 20%"/>
                        </div>
                        <hr>
                        <p>Nome: {{$produto['nome']}}</p>
                        <hr>
                        <p>Preço: {{$produto['preco']}}</p>
                        <hr>
                        <p>Quantidade: {{$produto['quantidade_solic']}}</p>
                        <input type="hidden" name="quantidade_solic[]" value="{{$produto['quantidade_solic']}}">
                        <hr>
                        <p>Preço Total: {{$produto['preco'] * $produto['quantidade_solic']}}</p>
                        <hr>
                        <p>Descrição: {{$produto['descricao']}}</p>
                    @endforeach
                @endif

                <div
                    style="margin-top:100px;display: flex; flex-direction: column; align-items: flex-start; justify-content: center; width: 100%; height: 20vh">
                    <label>Insira seu e-mail</label>
                    <select id="email" name="email" class="form-control">
                        <option value="">Escolha o seu e-mail</option>
                        @foreach($listaEmails as $email)
                            <option value="{{ $email['email'] }}">{{ $email['email'] }}</option>
                        @endforeach
                    </select>
                    <label>Informe o meio de pagamento</label>
                    <select name="meio_pagamento" style="margin-bottom: 10px; width: 100%">
                        <option type="text" value="Crédito" selected>Crédito</option>
                        <option type="text" value="Debito">Debito</option>
                        <option type="text" value="Pix">Pix</option>
                    </select>
                    <label>Preço total da compra</label>
                    <input type="number" name="preco_total" readonly value="{{isset($precoTotal) ? $precoTotal : 0}}"
                           style="width: 100%">
                    <label>Quantidade total da compra</label>
                    <input type="number" name="quantidade_total" readonly
                           value="{{isset($quantidadeTotal) ? $quantidadeTotal : 0}}" style="width: 100%">
                </div>
                <div style="width: 100%;display: flex;justify-content: flex-end; margin-top: 100px">
                    <button style="margin-right: 20px" class="btn btn-danger" type="submit"
                            formaction="{{ route('carrinho.limpar') }}" title="Limpar Carrinho"><i
                            class="fa fa-trash"></i>Limpar Carrinho
                    </button>
                    <button class="btn btn-success finalizar-compra" type="submit"><i class="fa fa-check"></i>Finalizar compra</button>
                </div>
            </form>
        </div>
    </div>

@endsection

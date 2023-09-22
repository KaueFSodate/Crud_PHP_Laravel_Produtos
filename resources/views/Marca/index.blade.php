@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Marca de Produtos</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered dataTable">
                <thead>
                <td>ID</td>
                <td>Nome</td>
                <td>Nome Fantasia</td>
                <td>Opções</td>
                </thead>
                <tbody>
                @foreach($listaMarcas as $item)
                    <tr>
                        <td>{{$item['id']}}</td>
                        <td>{{$item['nome']}}</td>
                        <td>{{$item['nome_fantasia']}}</td>
                        <td><a href="#" class="btn btn-success">
                                <li class="fa fa-edit">Alterar</li>
                            </a>
                            <a href="#" class="btn btn-danger" style="margin-left: 10px">
                                <li class="fa fa-trash">
                                    Excluir
                                </li>
                            </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @php

        @endphp
@endsection

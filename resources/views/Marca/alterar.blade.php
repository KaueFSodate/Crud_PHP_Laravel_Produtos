@extends('TemplateAdmin.index')

@section('contents')
    <h1 class="h3 mb-4 text-gray-800">Alterar Marca</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('marca.alterar', ['id' => $marca['id']]) }}" method="POST" style="display: flex; flex-direction: column">
            @csrf
                @method('POST')

                <label>Nome da Marca</label>
                <input type="text" name="nome" style="margin-bottom: 10px" placeholder="Nome" value="{{ $marca['nome'] }}">

                <label>Nome de Fantasia</label>
                <input type="text" name="nome_fantasia" style="margin-bottom: 10px" placeholder="Nome de Fantasia" value="{{ $marca['nome_fantasia'] }}">

                <label>Situação</label>
                <select name="situacao" style="margin-bottom: 10px">
                    <option value="1" {{ $marca['situacao'] == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ $marca['situacao'] == 0 ? 'selected' : '' }}>Inativo</option>
                </select>

                <div style="width: 100%; display: flex; justify-content: flex-end">
                    <button type="submit" class="btn btn-success" style="width: 10%">Alterar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

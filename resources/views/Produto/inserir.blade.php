@extends('TemplateAdmin.index')

@section('contents')
    @php
        $titulo = "Inclusão de um novo Produto";
        $endpoint = "/admin/produto/inserir";
        $input_name = "";
        $input_categoria = "";
        $input_marca = "";
        $input_cor = "";
        $input_preco = "";
        $input_quantidade = "";
        $input_descricao = "";
        $input_url_img = "";
        $input_id = "";
        $method = "post";
        if(isset($produto)){
            $input_id = $produto['id'];
            $titulo = "Alteração do Produto";
            $endpoint = "/admin/produto/alterar/$input_id";
            $input_name = $produto['nome'];
            $input_preco = $produto['preco'];
            $input_quantidade = $produto['quantidade'];
            $input_descricao = $produto['descricao'];
            $input_url_img = $produto['url_img'];
            $method = "put";
        }
    @endphp
    <h1 class="h3 mb-4 text-gray-800">{{$titulo}}</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ $endpoint }}" method="post" style="display: flex; flex-direction: column">
                @csrf
                <input type="hidden" name="id" value="{{$input_id}}" style="margin: 0"/>
                <label>Nome do Produto</label>
                <input type="text" name="nome" value="{{$input_name}}" style="margin-bottom: 10px" placeholder="Nome">
                <label>Preço do Produto</label>
                <input type="text" name="preco" value="{{$input_preco}}" style="margin-bottom: 10px" placeholder="Nome">
                <label>Categoria do Produto</label>
                <select name="categoria" style="margin-bottom: 10px">
                    @foreach($listaCategorias as $category)
                        <option value="{{$category['id']}}"
                            {{ (isset($categoria) && $category['id'] == $categoria->id) ? 'selected' : '' }}>
                            {{$category['nome']}}
                        </option>
                    @endforeach
                </select>


                <label>Marca do Produto</label>
                <select name="marca" style="margin-bottom: 10px">
                    @foreach($listaMarcas as $marc)
                        <option value="{{$marc['id']}}"
                            {{ (isset($marca) && $marc['id'] == $marca->id) ? 'selected' : '' }}>
                            {{$marc['nome']}}
                        </option>
                    @endforeach
                </select>

                <label>Cor do Produto</label>
                <select name="cor" style="margin-bottom: 10px">
                    @foreach($listaCores as $color)
                        <option value="{{$color['id']}}"
                            {{ (isset($cor) && $color['id'] == $cor->id) ? 'selected' : '' }}>
                            {{$color['cor']}}
                        </option>
                    @endforeach
                </select>

                <label>Quantidade de estoque do Produto</label>
                <input type="text" name="quantidade" value="{{$input_quantidade}}" style="margin-bottom: 10px"
                       placeholder="Nome">

                <label>Url da imagem do Produto</label>
                <input type="text" name="url_img" value="{{$input_url_img}}" style="margin-bottom: 10px"
                       placeholder="Nome">

                <label>Descrição do Produto</label>

                <textarea id="meuEditor" name="descricao">{{$input_descricao}}</textarea>

                <script>
                    tinymce.init({
                        selector: 'textarea#meuEditor',
                        plugins: 'autoresize',
                        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
                        autoresize_bottom_margin: 16,
                    });
                </script>

                <div style="width: 100%; display: flex; justify-content: flex-end">
                    <button type="submit" class="btn btn-success" style="width: 10%">Inserir</button>
                </div>
            </form>
        </div>
    </div>
@endsection

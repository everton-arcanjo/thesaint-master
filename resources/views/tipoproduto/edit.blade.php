@extends('principal')
@section('conteudo')

<form role="form" name="formTipoProduto" action="/tipoproduto/update/{{ $objTipoProduto->tpr_id }}" method="post">
        @csrf
        <div class="form-group">
            <label>Código Tipo Produto</label>
            <input class="form-control"  placeholder="Código Tipo Produto" name="tipoProduto[codigo]" value="{{ $objTipoProduto->tpr_codigo }}">
        </div>

        <div class="form-group">
            <label>Tipo Produto</label>
            <input class="form-control"  placeholder="Tipo Produto" name="tipoProduto[tipo]" value="{{ $objTipoProduto->tpr_tipo_produto }}">
        </div>

        <a href="#" class="btn btn-outline btn-primary" id="adicionarTipoProdutoModelo" style="margin-bottom: 5px">Adicionar</a>

        <table class="table" id="tabelaTipoProdutoMolde">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Cod</th>
                    <th scope="col">Molde</th>
                    <th scope="col">Consumo</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Tecido</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
                <tbody>

                </tbody>
            </table>

        <button type="submit" class="btn btn-default">Salvar</button>
        <button type="reset" class="btn btn-default" onclick="voltar('/tipoproduto')">Voltar</button>
    </form>

@endsection

@section('javascript')
    <script src={{ asset('js/tipoproduto.js') }} type="text/javascript"></script>
@endsection

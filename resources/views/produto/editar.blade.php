@extends('principal')
@section('conteudo')
@detalheproduto()@enddetalheproduto

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="min-height-200px">

            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div style="border-bottom: 1px solid black">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb" style="padding: 0px">
                            <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                            <li class="breadcrumb-item"><a href="/produto" style="color: black">Relação de Produtos</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: black;font-weight: bold">Alterar</li>
                        </ol>
                    </nav>
                </div>

                <form role="form" name="formProdutoFinal" action="/produto/update/{{ $produto->pro_id }}" method="post">
                    @csrf
                    <div id="msgUsuario"></div>
                    <div class="form-group">
                        <label>Tipo</label> <span style="color: red">*</span>
                        <input class="form-control" placeholder="Tipo" name="tipo" required="required" value="{{$produto->pro_tipo}}">
                    </div>

                    <div class="row">
                    </div>
                    <a href="#" class="btn btn-outline-dark" id="adicionarCaracterisca" style="margin-bottom: 5px">Adicionar</a>

                    <table class="table" id="tabelaProdutoCaracteristica">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Codigo <span style="color: red">*</span></th>
                                <th scope="col">Molde <span style="color: red">*</span></th>
                                <th scope="col">Consumo <span style="color: red">*</span></th>
                                <th scope="col">Unidade <span style="color: red">*</span></th>
                                <th scope="col">Cor <span style="color: red">*</span></th>
                                <th scope="col">Tecido <span style="color: red">*</span></th>
                                <th scope="col">Valor <span style="color: red">*</span></th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($caracteristicas as $caracterisrica)

                                    <tr>
                                        <td>
                                            <input class='form-control' type='text' onchange="verificaProdutoDuplicidade(this.value)" name='detalhe[codigo][]' value='{{ $caracterisrica->pca_codigo }}'>
                                            <input class='form-control' type='hidden' name='detalhe[pca_id][]' value='{{ $caracterisrica->pca_id }}'>

                                        </td>
                                        <td>
                                            <select class='form-control' name='detalhe[molde][]' onchange="buscaDadosMolde(this)">

                                                <option value="">Selecione</option>
                                                @foreach ($listaMolde as $molde)
                                                    <option @if( $caracterisrica->pca_mol_id == $molde->mol_id) selected='selected' @endif value="{{ $molde->mol_id }}">{{ $molde->mol_molde }}</option>
                                                @endforeach
                                            </select>

                                        </td>

                                        <td style='width: 130px'>
                                            <input readonly='readonly' type='text' class='form-control' value='@if( !is_null($caracterisrica->molde) ){{$caracterisrica->molde->mol_consumo}}@endif'>
                                        </td>

                                        <td style='width: 130px'>
                                            <input readonly='readonly' type='text' class='form-control' value='@if( !is_null($caracterisrica->molde) ){{exibeUnidade($caracterisrica->molde->mol_unidade)}}@endif'>
                                        </td>

                                        <td>
                                            <select class='form-control' name='detalhe[cor][]'>
                                                <option class='form-control' value="">Selecione</option>
                                                @foreach ($listaCor as $chave => $cor)
                                                    <option @if( $caracterisrica->pca_cor_id == $cor->cor_id) selected='selected' @endif value="{{ $cor->cor_id }}">{{$cor->cor_cor}}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <select class='form-control' name='detalhe[tecido][]'>
                                                <option value="">Selecione</option>
                                                @foreach ($listaTecido as $tecido)
                                                    <option @if( $caracterisrica->pca_tec_id == $tecido->tec_id) selected='selected' @endif value="{{ $tecido->tec_id }}"> {{$tecido->tec_tecido}} </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type='text' class='form-control' name='detalhe[valor][]' value='{{ $caracterisrica->pca_valor }}'>
                                        </td>

                                        <td>
                                            <button type='button' class='btn btn-outline-danger btn-sm' onclick="removerLinha( this )">Excluir</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <br>
                    <button type="reset" class="btn btn-dark btn-sm" onclick="voltar('/produto')">Voltar</button>
                    <button type="submit" class="btn btn-outline-dark btn-sm">Salvar</button>

                </form>

            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script src={{ asset('js/produto.js')}} type="text/javascript"></script>
@endsection

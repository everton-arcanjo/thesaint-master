@extends('principal')
@section('conteudo')

@forelse ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    {{$error}}
</div>
@empty
@endforelse

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                            <li class="breadcrumb-item"><a href="/estoque" style="color: black">Estoque</a></li>
                            <li class="breadcrumb-item active" style="color: black;font-weight: bold" aria-current="page">Alterar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        <form role="form" name="formMateriaPrima" action="/materiaprima/update/{{ $objMateriaPrima->mpr_id }}" method="post">
            @csrf

            <div class="form-group">
                <label>Tecido</label> <span style="color: red">*</span>
                <select class="form-control" name="tecido" required="required" disabled="disabled">
                    <option value="">Selecione</option>
                    @foreach ($listaTecido as $tecido)
                        <option @if( $objMateriaPrima->mpr_tec_id == $tecido->tec_id) selected='selected' @endif value="{{ $tecido->tec_id }}">{{ $tecido->tec_tecido }}</option>
                    @endforeach
                <select>
            </div>

            <div class="form-group">
                <label>Cor</label> <span style="color: red">*</span>
                <select class="form-control" name="cor" required="required" disabled="disabled">
                    <option value="">Selecione</option>
                    @foreach ($listaCor as $cor)
                        <option @if( $objMateriaPrima->mpr_cor_id == $cor->cor_id) selected='selected' @endif value="{{ $cor->cor_id }}">{{ $cor->cor_cor }}</option>
                    @endforeach
                <select>
            </div>

            <div class="form-group">
                <label>Quantidade Minima Em Estoque</label> <span style="color: red">*</span>
                <input type="text" class="form-control" placeholder="Quantidade Minima Em Estoque" id="qtdMinimaEstoque" name="qtdMinimaEstoque" required="required" value="{{number_format($objMateriaPrima->mpr_qtd_minima_estoque, 2, '.', '') }}">
            </div>

            <div class="form-group">
                <label>Quantidade Em Estoque</label>
                <input type="text" class="form-control" placeholder="Quantidade Em Estoque" id="qtdEstoque" name="qtdEstoque" required="required" readonly="readonly" value="{{number_format($objMateriaPrima->mpr_qtd_estoque, 2, '.', '') }}">
            </div>

            <hr>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Saida Tecido (Venda)</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Entrada Tecido (Compra)</a>
                </li>

              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Nº Pedido</th>
                                        <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Empresa</th>
                                        <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Data Venda</th>
                                        <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Qtd Saida (KG)</th>
                                        <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!is_null($listaPedidoProduto))
                                        @forelse ($listaPedidoProduto as $pedidoProduto)
                                            <tr role="row" class="odd" style="color: #000">
                                                <td>{{$pedidoProduto->pedido->ped_numero_pedido}}</td>
                                                <td>{{$pedidoProduto->pedido->cliente->cli_razao_social}}</td>
                                                <td>{{date("d/m/Y", strtotime($pedidoProduto->pedido->ped_data_pedido))}}</td>
                                                <td>{{$pedidoProduto->produtocaracteristica->molde->mol_consumo * ($pedidoProduto->ppr_qtd_pp + $pedidoProduto->ppr_qtd_p + $pedidoProduto->ppr_qtd_g + $pedidoProduto->ppr_qtd_gg)}}</td>
                                                <td>{{ number_format($pedidoProduto->produtocaracteristica->pca_valor * ($pedidoProduto->ppr_qtd_pp + $pedidoProduto->ppr_qtd_p + $pedidoProduto->ppr_qtd_g + $pedidoProduto->ppr_qtd_gg),2,",",".") }}</td>
                                            </tr>
                                        @empty
                                            <tr role="row" class="odd" style="color: #000">
                                                <td colspan="5" style="text-align: center">
                                                    Nenhum pedido foi vendido para esse tecido
                                                </td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr role="row" class="odd" style="color: #000">
                                            <td colspan="5" style="text-align: center">
                                                Nenhum pedido foi vendido para esse tecido
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            {{$listaPedidoProduto}}
                                        </td>
                                    </tr>
                                </tfoot>
                        </table>


                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr role="row">
                                <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Nº Pedido</th>
                                <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Data Compra</th>
                                <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Entrada  (KG)</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if(!is_null($listaMateriaPrimaCompra))
                                @forelse ($listaMateriaPrimaCompra as $materiaPrimaCompra)
                                    <tr role="row" class="odd" style="color: #000">
                                        <td>{{$materiaPrimaCompra->mtc_numero_pedido}}</td>
                                        <td>{{date("d/m/Y",strtotime($materiaPrimaCompra->mtc_data))}}</td>
                                        <td>{{number_format($materiaPrimaCompra->mtc_quantidade,2,",",".")}}</td>
                                    </tr>
                                @empty
                                    <tr role="row" class="odd" style="color: #000">
                                        <td colspan="3" style="text-align: center">
                                            Nenhuma compra foi realizada para esse tecido
                                        </td>
                                    </tr>
                                @endforelse
                            @else
                                <tr role="row" class="odd" style="color: #000">
                                    <td colspan="3" style="text-align: center">
                                        Nenhuma compra foi realizada para esse tecido
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    {{$listaMateriaPrimaCompra}}
                                </td>
                            </tr>
                        </tfoot>
                </table>
                </div>

            </div>

        <br>
        <button type="reset" class="btn btn-dark btn-sm" onclick="voltar('/estoque')">Voltar</button>
        <button type="submit" class="btn btn-outline-dark btn-sm">Salvar</button>
    </form>

        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/materiaprima.js') }}" type="text/javascript"></script>
@endsection

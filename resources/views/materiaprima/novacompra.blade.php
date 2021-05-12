@extends('principal')
@section('conteudo')

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
        <div class="min-height-200px">

            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <div style="border-bottom: 1px solid black">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb" style="padding: 0px">
                        <li class="breadcrumb-item"><a href="/">Principal</a></li>
                        <li class="breadcrumb-item"><a href="/compra">Solicitação de Compra de Matéria Prima</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
                    </ol>
                </nav>
            </div>

            <form role="form" name="formCompra" method="POST" action="/compra/salvarnovacompra">
                @csrf
                <div class="form-row">
                    <div class="form-group" style="margin-right: 20px">
                        <label for="nomeMateriaPrima">Número Pedido de Compra</label>
                        <input type="text" class="form-control" input="numeroPedidoMateriaPrima" name="compra[numero_pedido]" id="numeroPedidoMateriaPrima" placeholder="Número Pedido de Compra" required="required">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label for="nomeMateriaPrima">Número Nota Fiscal</label>
                        <input type="text" class="form-control" input="numeroNotaFiscal" id="numeroNotaFiscal" name="compra[numero_nota_fiscal]" placeholder="Número Nota Fiscal">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label>Data</label>
                        <input type="date" class="form-control" input="dataEstoque" id="dataEstoque" name="compra[data_estoque]" placeholder="Data" required="required">
                    </div>

                    <div class="form-group" style="width: 100px">
                        <label>Prazo</label>
                        <input type="number" class="form-control" input="prazo" id="prazo" name="compra[prazo]" placeholder="Prazo" min="1" max="99" required="required">
                    </div>

                    <div class="form-group" style="margin-left: 20px">
                        <label>Previsão de Recebimento</label>
                        <input type="date" readonly="readonly" class="form-control" name="compra[previsao_recebimento]" input="previsaoRecebimento" id="previsaoRecebimento" placeholder="Previsão de Recebimento" required="required">
                    </div>

                </div>

               <div class="row">
                   <div class="col-12">
                        <button type="button" class="btn btn-dark btn-sm" onclick="novoProduto()">Novo Produto</button>
                   </div>
               </div>

                <div class="row">

                    <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="tabelaMaisProduto">
                        <thead>
                            <tr role="row">
                                <th class="table-plus datatable-nosort">Tecido</th>
                                <th class="table-plus datatable-nosort">Cor</th>
                                <th class="table-plus datatable-nosort">Fornecedor</th>
                                <th class="table-plus datatable-nosort">Quantidade</th>
                                <th class="table-plus datatable-nosort">Unidade</th>
                                <th class="table-plus datatable-nosort">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>

                                    <select class="form-control" onchange="alterarLinha(this)" required="required" name="produto[tecido][]" style="width: 200px" required="required">
                                        <option value="">Selecione</option>
                                        @foreach ($listaTecido as $tecido)
                                            <option value="{{$tecido->tec_id}}">{{$tecido->tec_tecido}}</option>
                                        @endforeach
                                    <select>

                                    </td>
                                <td>

                                    <select class="form-control" name="produto[cor][]" required="required" style="width: 200px" required="required">
                                        <option value="">Selecione</option>
                                        @foreach ($listaCor as $cor)
                                            <option value="{{$cor->cor_id}}">{{$cor->cor_cor}}</option>
                                        @endforeach
                                    <select>

                                </td>
                                <td>

                                    <select class="form-control" name="produto[fornecedor][]" required="required" style="width: 250px" required="required">
                                        <option value="">Selecione</option>
                                        @foreach ($listaFornecedor as $fornecedor)
                                            <option value="{{$fornecedor->for_id}}">{{$fornecedor->for_razao_social}}</option>
                                        @endforeach
                                    <select>

                                </td>

                                <td>
                                    <input type="text" class="form-control" input="quantidade" name="produto[quantidade][]" required="required" id="quantidade" placeholder="Quantidade" required="required">
                                </td>

                                <td>
                                    <input type="text" readonly="readonly" class="form-control" name="produto[unidade][]" required="required" id="unidade" placeholder="Unidade" required="required">
                                </td>

                                <td>
                                    <a href="#"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <button type="reset" class="btn btn-dark btn-sm" onclick="voltar('/compra')">Voltar</button>
                <button type="submit" class="btn btn-outline-dark btn-sm">Salvar</button>

            </form>

            </div>
        </div>
    </div>

    @endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('js/compra.js') }}"></script>
@endsection

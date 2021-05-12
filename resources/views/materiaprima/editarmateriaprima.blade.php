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
                        <li class="breadcrumb-item active" aria-current="page">Alterar</li>
                    </ol>
                </nav>
            </div>

            <form role="form" name="formCompra" method="POST" action="/compra/atualizacompra/{{$objMateriaPrimaCompra->mtc_id}}">
                @csrf
                <div class="form-row">
                    <div class="form-group" style="margin-right: 20px">
                        <label for="nomeMateriaPrima">Número Pedido de Compra</label>
                        <input type="text" class="form-control" input="numeroPedidoMateriaPrima" name="compra[numero_pedido]" id="numeroPedidoMateriaPrima" placeholder="Número Pedido de Compra" required="required" value="{{$objMateriaPrimaCompra->mtc_numero_pedido}}">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label for="nomeMateriaPrima">Número Nota Fiscal</label>
                        <input type="text" class="form-control" input="numeroNotaFiscal" id="numeroNotaFiscal" name="compra[numero_nota_fiscal]" placeholder="Número Nota Fiscal" value="{{$objMateriaPrimaCompra->mtc_numero_pedido}}">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label>Data</label>
                        <input type="date" class="form-control" input="dataEstoque" id="dataEstoque" name="compra[data_estoque]" placeholder="Data" required="required" value="{{$objMateriaPrimaCompra->mtc_data}}">
                    </div>

                    <div class="form-group" style="width: 100px;">
                        <label>Prazo</label>
                        <input type="number" class="form-control" input="prazo" id="prazo" name="compra[prazo]" placeholder="Prazo" min="1" max="99" required="required" value="{{$objMateriaPrimaCompra->prazo}}">
                    </div>

                    <div class="form-group" style="margin-left: 20px">
                        <label>Previsão de Recebimento</label>
                        <input type="date" readonly="readonly" class="form-control" name="compra[previsao_recebimento]" input="previsaoRecebimento" id="previsaoRecebimento" placeholder="Previsão de Recebimento" required="required" value="{{$objMateriaPrimaCompra->mtc_data_previsao}}">
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
                             @forelse ($listaMateriaPrimaItem as $chave => $item)
                                <tr>
                                    <td>
                                        <input type="hidden" name="produto[id_item][{{$chave}}]" value="{{$item->mpi_id}}">
                                        <select class="form-control"  onchange="alterarLinha(this)" required="required" name="produto[tecido][{{$chave}}]" style="width: 200px" required="required">
                                            <option value="">Selecione</option>
                                            @foreach ($listaTecido as $tecido)
                                                <option @if($item->mpi_tec_id == $tecido->tec_id) selected="selected" @endif value="{{$tecido->tec_id}}">{{$tecido->tec_tecido}}</option>
                                            @endforeach
                                        <select>

                                    </td>
                                    <td>

                                        <select class="form-control" name="produto[cor][{{$chave}}]" required="required" style="width: 200px" required="required">
                                            <option value="">Selecione</option>
                                            @foreach ($listaCor as $cor)
                                                <option @if($item->mpi_cor_id == $cor->cor_id) selected="selected" @endif value="{{$cor->cor_id}}">{{$cor->cor_cor}}</option>
                                            @endforeach
                                        <select>

                                    </td>
                                    <td>

                                        <select class="form-control" name="produto[fornecedor][{{$chave}}]" required="required" style="width: 250px" required="required">
                                            <option value="">Selecione</option>
                                            @foreach ($listaFornecedor as $fornecedor)
                                                <option @if($item->mpi_for_id == $fornecedor->for_id) selected="selected" @endif value="{{$fornecedor->for_id}}">{{$fornecedor->for_razao_social}}</option>
                                            @endforeach
                                        <select>

                                    </td>

                                    <td>
                                        <input type="text" class="form-control" input="quantidade" name="produto[quantidade][{{$chave}}]" required="required"  placeholder="Quantidade" value="{{$item->mtc_quantidade}}">
                                    </td>

                                    <td>
                                        <input type="text" readonly="readonly" class="form-control" name="produto[unidade][{{$chave}}]" required="required"  placeholder="Unidade" value="{{$item->tecido->tec_unidade}}">
                                    </td>

                                    <td>
                                        <a href="#" onclick="removerLinha(this)">Excluir</a>
                                    </td>
                                </tr>
                             @empty
                                 <tr>
                                     <td colspan="6"></td>
                                 </tr>
                             @endforelse

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

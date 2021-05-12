<div id="modalcompra" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalcompraTitle">Matéria Prima Compra</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form role="form" name="formCompra">
                <input type="hidden" id="idMateriaPrimaCompra">

                <div id="msgUsuario"></div>

                <div class="form-row">
                    <div class="form-group" style="margin-right: 20px">
                        <label for="nomeMateriaPrima">Número Pedido de Compra</label>
                        <input type="text" class="form-control" input="numeroPedidoMateriaPrima" id="numeroPedidoMateriaPrima" placeholder="Número Pedido de Compra" required="required">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label for="nomeMateriaPrima">Número Nota Fiscal</label>
                        <input type="text" class="form-control" input="numeroNotaFiscal" id="numeroNotaFiscal" placeholder="Número Nota Fiscal">
                    </div>

                    <div class="form-group">
                        <label>Data</label>
                        <input type="date" class="form-control" input="dataEstoque" id="dataEstoque" placeholder="Data" required="required">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group" style="margin-right: 20px">
                        <label for="nomeMateriaPrima">Nome Materia Prima</label>
                        <input type="text" class="form-control" input="nomeMateriaPrima" id="nomeMateriaPrima" placeholder="Nome Materia Prima" readonly="readonly" required="required">
                    </div>


                    <div class="form-group" style="margin-right: 20px">
                        <label for="corMateriaPrima">Cor Materia Prima</label>
                        <input type="text" class="form-control" input="corMateriaPrima" id="corMateriaPrima" placeholder="Cor Materia Prima" readonly="readonly" required="required">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>Fornecedor</label>
                        <select class="form-control" id="fornecedor" style="width: 250px">
                            <option value="">Selecione</option>
                            @foreach ($listaFornecedor as $fornecedor)
                                <option value="{{$fornecedor->for_id}}">{{$fornecedor->for_razao_social}}</option>
                            @endforeach
                        <select>
                    </div>

                    <div class="form-group" style="width: 100px;margin-left: 20px">
                        <label>Prazo</label>
                        <input type="number" class="form-control" input="prazo" id="prazo" placeholder="Prazo" min="1" max="99" required="required">
                    </div>

                    <div class="form-group" style="margin-left: 20px">
                        <label>Previsão de Recebimento</label>
                        <input type="date" readonly="readonly" class="form-control" input="previsaoRecebimento" id="previsaoRecebimento" placeholder="Previsão de Recebimento" required="required">
                    </div>

                </div>

                <div class="form-group">
                    <label>Quantidade (KG)</label>
                    <input type="number" class="form-control" input="quantidade" id="quantidade" placeholder="Quantidade (KG)" min="1" max="999" required="required">
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" id="salvarCompra">Salvar</button>
        </div>
        </div>
    </div>
</div>

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/compra.js') }}"></script>
@endsection

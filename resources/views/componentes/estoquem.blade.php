<div id="modalestoque" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalestoqueTitle">Estoque</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div hidden class="alert alert-danger" role="alert" id="msg">
                Campos destacados devem ser preenchidos
             </div>

            <form role="form" name="formEstoque" action="#">

                <div class="form-group">
                    <label>Data</label>
                    <input type="date" class="form-control" input="dataEstoque" id="dataEstoque" placeholder="Data" required>
                </div>

                <div class="form-group">
                    <label>Fornecedor</label>
                    <input type="text" class="form-control" input="fornecedorEstoque" id="fornecedorEstoque" placeholder="Fornecedor" required>
                </div>

                <div class="form-group">
                    <label>Tipo</label>
                    <input type="text" class="form-control" input="tipoEstoque" id="tipoEstoque" placeholder="Tipo" required>
                </div>

                <div class="form-group">
                    <label>Tipo</label>
                    <input type="number" class="form-control" input="qtdKgEstoque" id="qtdKgEstoque" placeholder="QTD(KG)" required>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" id="fecharEstoque" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" id="adicionarEstoque" class="btn btn-primary">Adicionar</button>
        </div>
        </div>
    </div>
</div>

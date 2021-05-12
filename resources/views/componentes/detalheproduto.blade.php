<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalhe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="estoque-tab" data-toggle="pill" href="#estoque" role="tab" aria-controls="pills-home" aria-selected="true">Estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pedidos-tab" data-toggle="pill" href="#pedidos" role="tab" aria-controls="pills-profile" aria-selected="false">Pedidos</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="estoque" role="tabpanel" aria-labelledby="pills-home-tab">

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Data Solicitaçao/Retirada</th>
                                <th scope="col">Entrada/Saida</th>
                                <th scope="col">Qtd.Peças</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 120px">
                                    15/11/2018
                                </td>
                                <td style="width: 150px">
                                    Entrada
                                </td>
                                <td style="width: 120px">
                                    5
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 120px">
                                    15/11/2018
                                </td>
                                <td style="width: 150px">
                                    Saida
                                </td>
                                <td style="width: 120px">
                                    3
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 120px">Total</td>
                                <td></td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane fade" id="pedidos" role="tabpanel" aria-labelledby="pills-profile-tab">

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Número Pedido</th>
                                <th scope="col">Data</th>
                                <th scope="col">Qtd.Peças</th>
                                <th scope="col">Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 130px">
                                    555
                                </td>
                                <td style="width: 120px">
                                    15/11/2018
                                </td>
                                <td style="width: 150px">
                                    5
                                </td>
                                <td style="width: 120px">
                                    R$ 150,00
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

</div>

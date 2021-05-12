<br>
<button type="button" id="adicionarLinhaPedidoVenda" class="btn btn-outline btn-dark">Adicionar</button>
    <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="listaPedido" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;" width="100%">
        <thead>
            <tr role="row">
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;">Codigo<span style="color: red">*</span></th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;">Tipo<span style="color: red">*</span></th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;">Molde<span style="color: red">*</span></th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;">Cor <span style="color: red">*</span></th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;">Tecido <span style="color: red">*</span></th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;">PP (38)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;">P (40)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;">M (42)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;">G (44)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;">GG (46)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 60px;">QTD Total</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;">Valor Unit <span style="color: red">*</span></th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;">Valor <span style="color: red">*</span></th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @php $totalGeral = 0; @endphp
            @if(  isset($pedidoproduto) && count($pedidoproduto) > 0 )
                @foreach ($pedidoproduto as $produto)
                    <tr role="row">
                        <td style="padding: 0px">
                            <input type="text" onchange="buscaInfoProduto( this )" style="width: 80px;" name="produto[codigo][]" placeholder="Codigo" value="@if(isset($produto->produtocaracteristica)){{$produto->produtocaracteristica->pca_codigo}}@endif">
                            <input type="hidden" name="produto[pca_id][]" value="@if(isset($produto->produtocaracteristica)){{$produto->produtocaracteristica->pca_id}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input type="text" readonly="readonly" style="width: 100px;" name="produto[molde][]" placeholder="Tipo" value="@if(isset($produto->produtocaracteristica)){{$produto->produtocaracteristica->produto->pro_tipo}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input type="text" readonly="readonly" style="width: 100px;" name="produto[tipo][]" placeholder="Molde" value="@if(isset($produto->produtocaracteristica)){{$produto->produtocaracteristica->molde->mol_molde}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input type="text" readonly="readonly" style="width: 100px;" name="produto[cor][]" placeholder="Cor" value="@if(isset($produto->produtocaracteristica)){{$produto->produtocaracteristica->cor->cor_cor}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input type="text" readonly="readonly" style="width: 130px;" name="produto[tecido][]" placeholder="Tecido" value="@if(isset($produto->produtocaracteristica)){{$produto->produtocaracteristica->tecido->tec_tecido}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input onchange="somaPeca( this )" type="number" style="width: 45px;" name="produto[tamanho_pp][]" placeholder="PP" value="@if(isset($produto->produtocaracteristica)){{$produto->ppr_qtd_pp}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input onchange="somaPeca( this )" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_p][]" placeholder="P" value="@if(isset($produto->produtocaracteristica)){{$produto->ppr_qtd_p}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input onchange="somaPeca( this )" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_m][]" placeholder="M" value="@if(isset($produto->produtocaracteristica)){{$produto->ppr_qtd_m}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input onchange="somaPeca( this )" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_g][]" placeholder="G" value="@if(isset($produto->produtocaracteristica)){{$produto->ppr_qtd_g}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input onchange="somaPeca( this )" min="0" max="999" type="number" style="width: 45px;" name="produto[tamanho_gg][]" placeholder="GG" value="@if(isset($produto->produtocaracteristica)){{$produto->ppr_qtd_gg}}@endif">
                        </td>
                        <td style="padding: 0px;">
                            <input type="number" readonly="readonly" style="width: 50px;" name="produto[qtd_total][]" placeholder="Qtd.Total" value="{{$total = $produto->ppr_qtd_pp+$produto->ppr_qtd_p+$produto->ppr_qtd_m+$produto->ppr_qtd_g+$produto->ppr_qtd_gg }}">
                        </td>
                        <td style="padding: 0px">
                            <input type="text" readonly="readonly" style="width: 100px;" name="produto[valor_unitario][]" placeholder="Valor Unit" value="@if(isset($produto)){{ number_format( $produto->ppr_valor_unitario, 2, '.', ',' )}}@endif">
                        </td>
                        <td style="padding: 0px">
                            <input type="text" readonly="readonly" style="width: 100px;" name="produto[valor_total][]" placeholder="Total" value="{{ number_format($total*$produto->ppr_valor_unitario, 2, '.', ',') }}">
                        </td>
                        @php
                            $totalGeral+= $total*$produto->ppr_valor_unitario
                        @endphp
                        <td style="padding: 0px;">
                            <button onclick="removerLinhaPedido( this )" class="btn btn-danger btn-sm">Excluir</button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td>
                    Total
                </td>
                <td colspan="13" style="text-align: right">
                    <input type="number" readonly="readonly" id="valorTotalPedido" style="width: 170px;" placeholder="Valor Total (R$)" value="{{ number_format($totalGeral, 2, '.', ',')}}">
                </td>
            </tr>
        </tfoot>
    </table>



<table border="0" style="width: 100%;border: 1px solid black">
    <thead>
        <tr style="text-align: center">
            <td colspan="2">
                Pedido de Venda
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="width: 10%">
                <img src="{{ asset('img/logo_the_saint.jpg')}}">
            </td>
            <td>
                <table border="0" style="width: 100%;border: 1px solid black">
                    <tr>
                        <td><b>CNPJ:</b>CNPJ</td>
                    </tr>
                    <tr>
                        <td><b>Razão Social:</b>Razão Social</td>
                    </tr>
                    <tr>
                        <td><b>Endereço:</b>Endereço</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<br/>
<table style="width: 100%;border: 1px solid black">
    <tbody>
        <tr>
            <td>
                <b>Nº Pedido:</b> {{$objPedido->ped_numero_pedido}}
            </td>
         </tr>
         <tr>
            <td><b>Data Pedido:</b> {{date("d/m/Y", strtotime($objPedido->ped_data_pedido))}}</td>
            <td><b>Data Prevista de Entrega:</b>{{date("d/m/Y",strtotime($objPedido->ped_data_previsao))}}</td>
        </tr>
        <tr>
            <td><b>Forma de Entrega:</b> {{exibeFormaEntrega($objPedido->ped_forma_entrega)}}</td>
            <td><b>Forma de Pagamento:</b> {{exibeFormaPagamento($objPedido->ped_forma_pagamento)}}</td>
       </tr>
    </tbody>
</table>
<br>
<table border="0" style="width: 100%;border: 1px solid black">
        <tbody>
            <tr>
                <td><b>CNPJ:</b> {{formataCNPJ($objPedido->cliente->cli_cnpj)}}</td>
                <td colspan="2"><b>Inscrição Estadual:</b> {{$objPedido->cliente->cli_inscricao_estadual}}</td>
             </tr>
             <tr>
                <td colspan="2"><b>Razão Social:</b> {{$objPedido->cliente->cli_razao_social}}</td>
            </tr>
            <tr>
                <td colspan="2"><b>Nome Fantasia:</b> {{$objPedido->cliente->cli_nome_fantasia}}</td>
            </tr>

            <tr>
                <td colspan="2"><b>Nome Do Contato:</b> {{$objPedido->cliente->contato->cco_nome_contato}}</td>
            </tr>
            <tr>
                <td colspan="2"><b>Telefone Comercial:</b> {{$objPedido->cliente->contato->cco_telefone_comercial}}</td>
            </tr>
            <tr>
                <td><b>Celular:</b> {{$objPedido->cliente->contato->cco_celular}}</td>
                <td><b>Email:</b> {{$objPedido->cliente->contato->cco_email}}</td>
            </tr>
            <tr>
                <td><b>CEP:</b> {{$objPedido->cliente->endereco->cen_cep}}</td>
            </tr>
            <tr>
                <td><b>Endereço:</b> {{$objPedido->cliente->endereco->cen_endereco}}</td>
                <td><b>Número:</b> {{$objPedido->cliente->endereco->cen_numero}}</td>
                <td><b>Complemento:</b> {{$objPedido->cliente->endereco->cen_complemento}}</td>
            </tr>
            <tr>
                <td><b>Bairro:</b> {{$objPedido->cliente->endereco->cen_bairro}} </td>
                <td><b>Cidade:</b>{{$objPedido->cliente->endereco->cen_cidade}}</td>
                <td><b>Estado:</b>{{$objPedido->cliente->endereco->cen_estado}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%;border: 1px solid black" >
        <thead>
            <tr role="row">
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;border: 1px solid black">Codigo</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;border: 1px solid black">Tipo</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;border: 1px solid black">Cor</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;border: 1px solid black">Tecido</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;border: 1px solid black">PP (38)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;border: 1px solid black">P (40)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;border: 1px solid black">M (42)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;border: 1px solid black">G (44)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 40px;border: 1px solid black">GG (46)</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 60px;border: 1px solid black">QTD Total</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;border: 1px solid black">Valor Unit</th>
                <th tabindex="0" aria-controls="listaPedido" rowspan="1" colspan="1" style="width: 100px;border: 1px solid black">Valor</th>
            </tr>
        </thead>
        <tbody>
            @php $totalGeral = 0; @endphp
            @if(  isset($objPedido->pedidoproduto) && count($objPedido->pedidoproduto) > 0 )
                @foreach ($objPedido->pedidoproduto as $produto)
                    <tr role="row">
                        <td style="padding: 0px;border: 1px solid black">{{$produto->produtocaracteristica->pca_codigo}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->produtocaracteristica->produto->pro_tipo}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->produtocaracteristica->cor->cor_cor}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->produtocaracteristica->tecido->tec_tecido}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->ppr_qtd_pp}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->ppr_qtd_p}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->ppr_qtd_m}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->ppr_qtd_g}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$produto->ppr_qtd_gg}}</td>
                        <td style="padding: 0px;border: 1px solid black">{{$total = $produto->ppr_qtd_pp+$produto->ppr_qtd_p+$produto->ppr_qtd_m+$produto->ppr_qtd_g+$produto->ppr_qtd_gg }}</td>
                        <td style="padding: 0px;border: 1px solid black">R$ {{ number_format( $produto->ppr_valor_unitario, 2, '.', ',' )}}</td>
                        <td style="padding: 0px; text-align: right;;border: 1px solid black">R$ {{ number_format($total*$produto->ppr_valor_unitario, 2, '.', ',') }}</td>
                        @php
                            $totalGeral+= $total*$produto->ppr_valor_unitario
                        @endphp
                    </tr>
                @endforeach
            @endif()
        </tbody>
        <tfoot>
            <tr>
                <td>
                    Total
                </td>
                <td colspan="11" style="text-align: right">
                    R$ {{ number_format($totalGeral, 2, '.', ',')}}
                </td>
            </tr>
        </tfoot>
    </table>

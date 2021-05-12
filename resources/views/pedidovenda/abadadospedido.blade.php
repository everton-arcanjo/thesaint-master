<br>

<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>Número do Pedido:</label> <span style="color: red">*</span>
        <input type="text" class="form-control" onchange="validaAbaPedidoGeral()" required="required" readonly="readonly" maxlength="30" name="pedido[numero_pedido]" placeholder="Número do Pedido" value="@if( isset($pedido) ){{ $pedido->ped_numero_pedido }}@else {{$numeroPedido}} @endif">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>Data Pedido:</label> <span style="color: red">*</span>
            <input type="date" class="form-control" onchange="validaAbaPedidoGeral()" required="required" name="pedido[data_pedido]" placeholder="Data Pedido" value="@if(isset($pedido)){{$pedido->ped_data_pedido}}@endif">
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group">
            <label>Data Prevista de Entrega:</label> <span style="color: red">*</span>
            <input type="date" class="form-control" onchange="validaAbaPedidoGeral()" required="required" name="pedido[data_prevista]" placeholder="Data Prevista de Entrega" value="@if(isset($pedido)){{$pedido->ped_data_previsao}}@endif">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>Forma de Entrega:</label> <span style="color: red">*</span>
            <select name="pedido[forma_entrega]" onchange="validaAbaPedidoGeral()" class="form-control" required="required">
                <option value="">Selecione</option>
                <option @if( isset($pedido) && $pedido->ped_forma_entrega == 'LU') selected='selected' @endif value="LU">Lote Único</option>
                <option @if( isset($pedido) && $pedido->ped_forma_entrega == '2L') selected='selected' @endif value="2L">2 Lotes</option>
                <option @if( isset($pedido) && $pedido->ped_forma_entrega == '3L') selected='selected' @endif value="3L">3 Lotes</option>
            </select>
        </div>
    </div>
    <div class="col-sm">
        <div class="form-group">
            <label>Forma de Pagamento:</label> <span style="color: red">*</span>
            <select name="pedido[forma_pagamento]" onchange="validaAbaPedidoGeral()" class="form-control" required="required">
                <option value="">Selecione</option>
                <option @if( isset($pedido) && $pedido->ped_forma_pagamento == '1') selected='selected' @endif value="1">Dinheiro</option>
                <option @if( isset($pedido) && $pedido->ped_forma_pagamento == '2') selected='selected' @endif value="2">Cheque</option>
                <option @if( isset($pedido) && $pedido->ped_forma_pagamento == '3') selected='selected' @endif value="3">30</option>
                <option @if( isset($pedido) && $pedido->ped_forma_pagamento == '4') selected='selected' @endif value="4">30/60</option>
                <option @if( isset($pedido) && $pedido->ped_forma_pagamento == '5') selected='selected' @endif value="5">30/60/90</option>
                <option @if( isset($pedido) && $pedido->ped_forma_pagamento == '6') selected='selected' @endif value="6">30/60/90/120</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>Observaões:</label>
            <textarea name="pedido[observacao]" class="form-control" style="height: 120px">@if( isset($pedido) ) {{ $pedido->ped_observacao }} @endif</textarea>
        </div>
    </div>
</div>

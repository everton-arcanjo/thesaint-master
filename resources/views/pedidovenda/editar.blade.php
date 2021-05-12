@extends('principal')
@section('conteudo')

<div id="msgUsuario"></div>

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
        <div class="min-height-200px">

            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div style="border-bottom: 1px solid black">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb" style="padding: 0px">
                            <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                            <li class="breadcrumb-item"><a href="/pedidovenda" style="color: black">Relação Pedido de Vendas</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#" style="color: black;font-weight: bold">Alterar</a></li>
                        </ol>
                    </nav>
                </div>


<form role="form" name="formPedidoVenda" action="/pedidovenda/update/{{ $objPedido->ped_id }}" method="post">
    @csrf
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pedido-tab" data-toggle="tab" href="#pedido" role="tab" aria-controls="home" aria-selected="true">Dados Pedido</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="cliente-tab" data-toggle="tab" href="#cliente" role="tab" aria-controls="cliente" aria-selected="false">Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="produto-tab" data-toggle="tab" href="#produto" role="tab" aria-controls="produto" aria-selected="false">Produto</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
            <!-- FORMULARIO DO PEDIDO -->
            <div class="tab-pane fade show active" id="pedido" role="tabpanel" aria-labelledby="pedido-tab">
                @include('pedidovenda.abadadospedido', ['pedido' => $objPedido])
            </div>
            <!-- FIM FORMULARIO DO PEDIDO -->

            <!-- FORMULARIO DO CLIENTE -->
            <div class="tab-pane fade" id="cliente" role="tabpanel" aria-labelledby="cliente-tab">
                @include('pedidovenda.abadadoscliente', ['cliente' => $objPedido->cliente])
            </div>
            <!-- FIM FORMULARIO DO CLIENTE -->

            <!-- FIM FORMULARIO DE PRODUTO -->
            <div class="tab-pane fade" id="produto" role="tabpanel" aria-labelledby="produto-tab">
                @include('pedidovenda.abaproduto', ['pedidoproduto' => $objPedido->pedidoproduto])
            </div>
            <!-- FIM FORMULARIO DE PRODUTO -->

        </div>

        <button type="reset" class="btn btn-dark btn-sm" onclick="voltar('/pedidovenda')">Voltar</button>
        <button type="submit" class="btn btn-outline-dark btn-sm">Salvar</button>

</form>



            </div>
        </div>
    </div>

@endsection


@section('javascript')
    <script src="{{ asset('js/pedidovenda.js') }}" type="text/javascript"></script>
@endsection

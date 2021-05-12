@extends('principal')
@section('conteudo')


<div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                        <li class="breadcrumb-item"><a href="#" style="color: black;font-weight: bold">Relação Pedido de Vendas</a></li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>

    <div class="pd-10 bg-white border-radius-4 box-shadow mb-10">
        <form action="/pedidovenda">
            <div class="form-inline">

                <label for="Nº Pedido">Nº Pedido:</label>
                <input type="text" class="form-control" style="margin-right: 5px;" name="filtro[numero_pedido]" id="numeroPedido "placeholder="Nº Pedido">

                <label for="Empresa">Empresa:</label>
                <input type="text" class="form-control" style="margin-right: 5px;" name="filtro[empresa]" id="empresaPedido "placeholder="Empresa">

                <label for="CNPJ">CNPJ:</label>
                <input type="text" class="form-control" style="margin-right: 5px;" name="filtro[cnpj]" id="cnpjEmpresaPedido "placeholder="CNPJ">

                <label for="Data Prevista">Data Prevista:</label>
                <input type="date" class="form-control" style="margin-right: 5px;" name="filtro[data_prevista]" id="dataPrevistaPedido "placeholder="Data Prevista">

                <label for="Forma de Entrega">Forma de Entrega</label>
                <select name="filtro[forma_entrega]" class="form-control" style="margin-right: 5px;">
                        <option value="">Selecione</option>
                        <option value="LU">Lote Único</option>
                        <option value="2L">2 Lotes</option>
                        <option value="3L">3 Lotes</option>
                    </select>

                <label for="Forma Lançamento">Forma Lançamento</label>
                <select name="filtro[forma_pagamento]" class="form-control" style="margin-right: 15px">
                    <option value="">Selecione</option>
                    <option value="1">Dinheiro</option>
                    <option value="2">Cheque</option>
                    <option value="3">30</option>
                    <option value="4">30/60</option>
                    <option value="5">30/60/90</option>
                    <option value="6">30/60/90/120</option>
                </select>

                    <label for="Forma Lançamento">Status</label>
                    <select name="filtro[status]" class="form-control" style="margin-right: 15px">
                        <option value="">Selecione</option>
                        <option value="AG">Aguardando Aprovação</option>
                        <option value="AP">Aprovado</option>
                        <option value="RE">Recusado</option>
                    </select>

                    <button type="submit" class="btn btn-dark" style="margin-right: 15px">Buscar</button>
                    <a href="/pedidovenda/create" class="btn btn-dark">
                        <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                        Cadastrar
                    </a>
            </div>
        </form>
    </div>
</div>

<div class="pd-10 bg-white border-radius-4 box-shadow mb-10">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
        <div class="col-sm-12">
            @if(Auth::user()->usu_dep_id == "1")
                <div class="row" id="acaoAprovar" style="display: none;">
                    <div class="col-sm-1" style="margin-right: 1%">
                        <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Aprovar" onclick="aprovarRecusar('S')">
                            <i class="fas fa-thumbs-up"></i>
                            Aprovar
                        </button>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-danger" data-toggle="tooltip" title="Recusar" onclick="aprovarRecusar('R')">
                            <i class="fas fa-thumbs-down"></i>
                            Recusar
                        </button>
                    </div>
                </div>
            @endif
            <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                <thead>
                    <tr role="row">
                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">
                            @if(Auth::user()->usu_dep_id == "1")
                                <input type="checkbox"  class="check-input" id="selecaoPrincipal" value="S"/>
                            @endif
                        </th>

                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">Nº Pedido</th>
                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">Empresa</th>
                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">CNPJ</th>
                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">Data Prevista</th>
                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">Forma de Entrega</th>
                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">Valor</th>
                        <th class="table-plus" tabindex="0"  rowspan="1" colspan="1">Status</th>
                        <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listaPedido as $chave => $pedido)
                        <tr role="row"  @if($chave%2 == '0') class="odd" @else class="even" @endif style="color: #000">

                            <td class="table-plus sorting_1" tabindex="0">
                                @if($pedido->ped_status_aprovacao == 'AG' && Auth::user()->usu_dep_id == "1")
                                    <input type="checkbox" class="check-input" onclick="selecaoUnica(event)" id="pedidoSelecao{{$pedido->ped_id}}" name="pedidoSelecao[{{$pedido->ped_id}}]" value="{{$pedido->ped_id}}"/>
                                @endif
                            </td>

                            <td class="table-plus sorting_1" tabindex="0">{{ $pedido->ped_numero_pedido }}</td>
                            <td data-placement="right" data-toggle="tooltip" title="{{$pedido->cliente->cli_razao_social}}">@if(!is_null($pedido->cliente)) {{str_limit($pedido->cliente->cli_razao_social, 20)}} @endif</td>
                            <td>@if(!is_null($pedido->cliente)) {{ $pedido->cliente->cli_cnpj }} @endif</td>
                            <td>{{ date("d/m/Y", strtotime($pedido->ped_data_previsao)) }}</td>
                            <td>{{exibeFormaEntrega($pedido->ped_forma_entrega)}}</td>
                            <td>
                                R$ {{exibeTotalVenda($pedido->pedidoproduto)}}
                            </td>
                            <td>{{descricaoAprovacao($pedido->ped_status_aprovacao)}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>Visualizar</a>-->
                                        <a class="dropdown-item" href="/pedidovenda/gerarpdf/{{ $pedido->ped_id }}"><i class="fa fa-file-pdf-o"></i>Gerar PDF</a>
                                            <a class="dropdown-item" href="/pedidovenda/edit/{{ $pedido->ped_id }}"><i class="fa fa-pencil"></i>Editar</a>
                                            <a class="dropdown-item" href="/pedidovenda/destroy/{{ $pedido->ped_id }}"><i class="fa fa-trash"></i>Deletar</a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr role="row" class="odd">
                            <td colspan="9" style="text-align: center">Nenhum Registro de Venda Lançado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            {{$listaPedido->currentPage()}}-{{$listaPedido->lastPage()}} de {{$listaPedido->count()}} registros
                    </div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                        {{$listaPedido->appends($_GET)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

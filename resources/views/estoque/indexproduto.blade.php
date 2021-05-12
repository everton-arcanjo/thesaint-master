@extends('principal')
@section('conteudo')

<div class="pd-ltr-15 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/" style="color: black">Principal
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="/estoqueproduto/indexproduto" style="color: black;font-weight: bold">Estoque Produto</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-10 bg-white border-radius-4 box-shadow mb-10">
                    <form action="/estoqueproduto/indexproduto">
                        <div class="form-inline">
                            <label for="Codigo">Código:</label>
                            <input type="text" class="form-control" style="margin-right: 5px;" name="filtro[codigo]" id="codigo "placeholder="Código">
                            <label for="Material">Material:</label>
                            <input type="text" class="form-control" style="margin-right: 5px;" name="filtro[material]" id="material "placeholder="Material">
                            <label for="Cor">Cor:</label>
                            <select name="filtro[cor]" id="cor" class="form-control" style="margin-right: 5px;">
                                <option value="">Selecione:</option>
                                @foreach ($listaCor as $cor)
                                    <option value="{{$cor->cor_id}}">{{$cor->cor_cor}}</option>
                                @endforeach
                            </select>
                            <label for="Estoque">Estoque:</label>
                            <select name="filtro[nivel]" id="cor" class="form-control" style="margin-right: 15px">
                                    <option value="">Selecione</option>
                                    <option value="B">Baixo</option>
                                    <option value="A">Alto</option>
                            </select>
                            <button type="submit" class="btn btn-dark" style="margin-right: 15px">Buscar</button>
                        </div>
                    </form>

            </div>

            <div class="pd-10 bg-white border-radius-4 box-shadow mb-10">
                <div class="row">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                    <div class="col-sm-12">

                        <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="table-plus datatable-nosort" rowspan="1" colspan="1" aria-label="Name">Código</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Molde</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Tecido</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Cor</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Tipo</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">PP</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">P</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">M</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">G</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">GG</th>

                                    <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listaProduto as $chave => $produto)
                                    <tr role="row"  @if($chave%2 == '0') class="odd" @else class="even" @endif style="color: #000">
                                        <td class="table-plus sorting_1" tabindex="0">
                                            {{$produto->pca_codigo}}
                                        </td>
                                        <td class="table-plus sorting_1" tabindex="0">@if(isset($produto->molde)){{$produto->molde->mol_molde}}@endif</td>
                                        <td>@if(isset($produto->tecido)){{$produto->tecido->tec_tecido}}@endif</td>
                                        <td>@if(isset($produto->cor)){{$produto->cor->cor_cor}}@endif</td>
                                        <td>@if(isset($produto->produto)){{$produto->produto->pro_tipo}}@endif</td>
                                        <td>@if(isset($produto->estoque))@php echo verificaEstoque($produto->estoque->epr_qtd_minima_pp,$produto->estoque->epr_qtd_estoque_pp) @endphp {{$produto->estoque->epr_qtd_estoque_pp}}@endif</td>
                                        <td>@if(isset($produto->estoque))@php echo verificaEstoque($produto->estoque->epr_qtd_minima_p,$produto->estoque->epr_qtd_estoque_p) @endphp  {{$produto->estoque->epr_qtd_estoque_p}}@endif</td>
                                        <td>@if(isset($produto->estoque))@php echo verificaEstoque($produto->estoque->epr_qtd_minima_m,$produto->estoque->epr_qtd_estoque_m) @endphp  {{$produto->estoque->epr_qtd_estoque_m}}@endif</td>
                                        <td>@if(isset($produto->estoque))@php echo verificaEstoque($produto->estoque->epr_qtd_minima_g,$produto->estoque->epr_qtd_estoque_g) @endphp  {{$produto->estoque->epr_qtd_estoque_g}}@endif</td>
                                        <td>@if(isset($produto->estoque))@php echo verificaEstoque($produto->estoque->epr_qtd_minima_gg,$produto->estoque->epr_qtd_estoque_gg) @endphp {{$produto->estoque->epr_qtd_estoque_gg}}@endif</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>Visualizar</a> -->
                                                    <a class="dropdown-item" href="/estoqueproduto/editproduto/{{$produto->pca_id}}"><i class="fa fa-pencil"></i>Editar</a>
                                                    <!--<a class="dropdown-item" href="/estoqueproduto/destroyproduto/"><i class="fa fa-trash"></i>Deletar</a>-->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row" class="odd">
                                        <td colspan="11" style="text-align: center">Nenhum Registro De Estoque Lançado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                    </table>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{$listaProduto->currentPage()}}-{{$listaProduto->lastPage()}} de {{$listaProduto->count()}} registros
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                {{$listaProduto->appends($_GET)->links()}}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

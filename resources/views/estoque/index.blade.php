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
                                    <a href="/estoque" style="color: black;font-weight: bold">Estoque</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="pd-10 bg-white border-radius-4 box-shadow mb-10">
                    <form action="/estoque">
                        <div class="form-inline">
                            <label for="Tecido">Tecido:</label>
                                <select name="filtro[tecido]" id="tecido" class="form-control" style="margin-right: 5px;">
                                    <option value="">Selecione</option>
                                    @foreach ($listaTecido as $tecido)
                                        <option value="{{$tecido->tec_id}}">{{$tecido->tec_tecido}}</option>
                                    @endforeach
                                </select>

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
                            <a href="/materiaprima/create" class="btn btn-dark">
                                <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                Cadastrar
                            </a>

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
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Tecido</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Cor</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Quantidade Minima</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Quantidade Em Estoque</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Unidade</th>
                                    <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listaMateriaPrima as $chave => $materiaPrima)
                                    <tr role="row"  @if($chave%2 == '0') class="odd" @else class="even" @endif style="color: #000">
                                        <td>
                                                @if( $materiaPrima->mpr_qtd_estoque <= $materiaPrima->mpr_qtd_minima_estoque ) <i class="fas fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="Estoque Baixo"></i>  @endif

                                            @if( !is_null($materiaPrima->tecido) ) {{ $materiaPrima->tecido->tec_tecido }}@endif
                                        </td>
                                        <td>@if( !is_null($materiaPrima->cor) ) {{ $materiaPrima->cor->cor_cor }}@endif</td>
                                        <td>{{ formataValorUnidade($materiaPrima->mpr_qtd_minima_estoque,2) }}</td>
                                        <td>{{ formataValorUnidade($materiaPrima->mpr_qtd_estoque,2) }}</td>
                                        <td>{{ exibeUnidade($materiaPrima->tecido->tec_unidade) }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>Visualizar</a> -->
                                                    <a class="dropdown-item" href="/materiaprima/edit/{{ $materiaPrima->mpr_id }}"><i class="fa fa-pencil"></i>Editar</a>
                                                    <a class="dropdown-item" href="/materiaprima/destroy/{{ $materiaPrima->mpr_id }}"><i class="fa fa-trash"></i>Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row" class="odd">
                                        <td colspan="5" style="text-align: center">Nenhum Registro De Estoque Lançado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                    </table>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{$listaMateriaPrima->currentPage()}}-{{$listaMateriaPrima->lastPage()}} de {{$listaMateriaPrima->count()}} registros
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                {{$listaMateriaPrima->appends($_GET)->links()}}
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

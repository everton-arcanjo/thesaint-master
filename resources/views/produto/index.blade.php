@extends('principal')
@section('conteudo')


<div class="pd-ltr-15 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
        <div class="min-height-200px">

        <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                                <li class="breadcrumb-item"><a href="#" style="color: black;font-weight: bold">Relação de Produtos</a></li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>


            <div class="pd-10 bg-white border-radius-4 box-shadow mb-10">

                <form action="/produto">
                    <div class="form-inline">
                        <label for="Produto">Produto:</label>
                        <input type="text" class="form-control" name="produto" id="produto" placeholder="Produto" style="margin-right: 15px">
                        <button type="submit" class="btn btn-dark" style="margin-right: 15px">Buscar</button>
                        <a href="/produto/create" class="btn btn-dark">
                            <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                            Cadastrar
                        </a>
                    </div>
                </form>

            </div>

            <div class="pd-10main-container bg-white border-radius-4 box-shadow mb-10">
                <div class="row">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                    <div class="col-sm-12">

                        <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Produto</th>
                                    <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listaProduto as $chave => $produto)
                                    <tr role="row"  @if($chave%2 == '0') class="odd" @else class="even" @endif style="color: #000">
                                        <td class="table-plus sorting_1" tabindex="0">{{ $produto->pro_tipo }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!--<a class="dropdown-item" href="#"><i class="fa fa-eye"></i>Visualizar</a>-->
                                                    <a class="dropdown-item" href="/produto/edit/{{ $produto->pro_id }}"><i class="fa fa-pencil"></i>Editar</a>
                                                    <a class="dropdown-item" href="/produto/destroy/{{ $produto->pro_id }}"><i class="fa fa-trash"></i>Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row" class="odd">
                                        <td colspan="5" style="text-align: center">Nenhum Produto Cadastrado</td>
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

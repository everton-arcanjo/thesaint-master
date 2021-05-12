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
                                    <li class="breadcrumb-item"><a href="#" style="color: black;font-weight: bold">Relação de Fornecedores</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

            <div class="pd-10 bg-white border-radius-4 box-shadow mb-10">

                <form action="/fornecedor">
                    <div class="form-inline">
                        <label for="Razão Social">Razão Social:</label>
                        <input type="text" class="form-control" style="margin-right:5px" name="filtro[razao_social]" id="razaoSocial" placeholder="Razão Social">
                        <label for="CNPJ">CNPJ:</label>
                        <input type="text" class="form-control" style="margin-right:5px" name="filtro[cnpj]" id="cnpj "placeholder="CNPJ">
                        <label for="Cor">E-mail:</label>
                        <input type="text" class="form-control" name="filtro[email]" style="margin-right:5px" id="email "placeholder="E-mail">
                        <label for="Cor">Telefone:</label>
                        <input type="text" class="form-control" style="margin-right: 15px" name="filtro[telefone]" id="telefone "placeholder="Telefone">

                        <button type="submit" class="btn btn-dark" style="margin-right: 15px">Buscar</button>
                        <a href="/fornecedor/create" class="btn btn-dark">
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
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Razão Social</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">CNPJ</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">E-mail</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Telefone</th>
                                    <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listaFornecedor as $chave => $fornecedor)
                                    <tr role="row"  @if($chave%2 == '0') class="odd" @else class="even" @endif style="color: #000">
                                        <td class="table-plus sorting_1" tabindex="0">{{$fornecedor->for_razao_social}}</td>
                                        <td>{{formataCNPJ( $fornecedor->for_cnpj )}}</td>
                                        <td>{{$fornecedor->for_email}}</td>
                                        <td>{{$fornecedor->for_telefone}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!--<a class="dropdown-item" href="#"><i class="fa fa-eye"></i>Visualizar</a>-->
                                                    <a class="dropdown-item" href="/fornecedor/edit/{{ $fornecedor->for_id }}"><i class="fa fa-pencil"></i>Editar</a>
                                                    <a class="dropdown-item" href="/fornecedor/destroy/{{ $fornecedor->for_id }}"><i class="fa fa-trash"></i>Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row" class="odd">
                                        <td colspan="5" style="text-align: center">Nenhum Registro de Venda Lançado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                    </table>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{$listaFornecedor->currentPage()}}-{{$listaFornecedor->lastPage()}} de {{$listaFornecedor->count()}} registros
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                {{$listaFornecedor->appends($_GET)->links()}}
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


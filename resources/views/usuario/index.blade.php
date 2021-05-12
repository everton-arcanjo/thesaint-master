@extends('principal')
@section('conteudo')

<div class="pd-ltr-10 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;">
    <div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;">
        <div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
        <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                                    <li class="breadcrumb-item"><a href="#" style="color: black;font-weight: bold">Relação de Usuários</a></li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>

            <div class="pd-10 bg-white border-radius-4 box-shadow mb-10">
                <form action="/usuario">
                    <div class="form-inline">
                        <div class="form-group">
                            <label for="Nome">Nome:</label>
                            <input type="text" class="form-control" style="margin-right: 5px" name="filtro[nome]" id="nome" aria-describedby="Nome" placeholder="Nome">
                        </div>
                        <label for="E-mail">E-mail:</label>
                        <input type="text" class="form-control" style="margin-right: 5px" name="filtro[email]" id="email" placeholder="E-email">
                        <label for="Login">Login:</label>
                        <input type="text" class="form-control" style="margin-right: 10px" name="filtro[login]" id="login" placeholder="Login">

                        <div class="form-row" style="margin-top: 5px">
                            <label for="Departamento">Departamento:</label>
                            <select  class="form-control" style="margin-right: 15px" name="filtro[departamento]" id="departamento">
                                <option value="">Selecione</option>
                                @foreach ($listaDepartamento as $departamento)
                                    <option  @if( old('usuario.departamento') == $departamento->dep_id) selected="selected" @endif value="{{$departamento->dep_id}}">{{$departamento->dep_nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row" style="margin-top: 5px">
                            <button type="submit" class="btn btn-dark" style="margin-right: 5px">Buscar</button>
                            <a href="/usuario/create" class="btn btn-dark">
                                <i class="icon-copy fa fa-plus" aria-hidden="true"></i>
                                Cadastrar
                            </a>
                        </div>

                    </div>
                </form>
            </div>

            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <div class="row">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                    <div class="col-sm-12">
                        <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Nome: activate to sort column ascending">Nome</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Login: activate to sort column ascending">Login</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Departamento: activate to sort column ascending">Departamento</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Celular: activate to sort column ascending">Celular</th>
                                    <th class="datatable-nosort sorting_disabled" rowspan="1" colspan="1" aria-label="Action">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listaUsuario as $chave => $usuario)
                                    <tr role="row"  @if($chave%2 == '0') class="odd" @else class="even" @endif style="color: #000">
                                        <td>{{$usuario->usu_nome}}</td>
                                        <td>{{$usuario->usu_email}}</td>
                                        <td>{{$usuario->usu_login}}</td>
                                        <td>{{$usuario->usu_telefone}}</td>
                                        <td>{{$usuario->usu_telefone}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <!-- <a class="dropdown-item" href="#"><i class="fa fa-eye"></i>Visualizar</a> -->
                                                    <a class="dropdown-item" href="/usuario/edit/{{ $usuario->usu_id }}"><i class="fa fa-pencil"></i>Editar</a>
                                                    <a class="dropdown-item" href="/usuario/destroy/{{ $usuario->usu_id }}"><i class="fa fa-trash"></i>Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row" class="odd">
                                        <td colspan="6" style="text-align: center">Nenhum Usuário Cadastrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                    </table>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                                {{$listaUsuario->currentPage()}}-{{$listaUsuario->lastPage()}} de {{$listaUsuario->count()}} registros
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                {{$listaUsuario->appends($_GET)->links()}}
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


@extends('principal')
@section('conteudo')

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="min-height-200px">
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <div style="border-bottom: 1px solid black">
                            <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb" style="padding: 0px">
                                        <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                                        <li class="breadcrumb-item"><a href="/estoqueproduto/indexproduto" style="color: black">Estoque Produto</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a href="#" style="color: black;font-weight: bold">Alterar</a></li>
                                    </ol>
                            </nav>
                        </div>

                <form role="form" name="formCor" action="/estoqueproduto/updateestoque/{{ $objProduto->pca_id }}" method="post" style="margin-top: 20px">
                    @csrf
                    <div class="form-group">
                        <label>Código</label>
                        <input class="form-control" readonly="readonly" maxlength="30" type="text" name="codigo" id="codigo" value="{{ $objProduto->pca_codigo }}" placeholder="Código" required="required">
                    </div>

                    <div class="form-group">
                        <label>Molde</label> <span style="color: red">*</span>
                        <input class="form-control" readonly="readonly" maxlength="30" type="text" name="molde" id="molde" value="@if(isset($objProduto->molde)){{$objProduto->molde->mol_molde}}@endif" placeholder="Cor" required="required">
                    </div>

                    <div class="form-group">
                        <label>Tecido</label> <span style="color: red">*</span>
                        <input class="form-control" readonly="readonly" maxlength="30" type="text" name="tecido" id="tecido" value="@if(isset($objProduto->tecido)){{$objProduto->tecido->tec_tecido}}@endif" placeholder="Tecido" required="required">
                    </div>

                    <div class="form-group">
                        <label>Cor</label> <span style="color: red">*</span>
                        <input class="form-control" readonly="readonly" maxlength="30" type="text" name="cor" id="cor" value="@if(isset($objProduto->cor)){{$objProduto->cor->cor_cor}}@endif" placeholder="Cor" required="required">
                    </div>

                    <div class="form-group">
                        <label>Tipo</label> <span style="color: red">*</span>
                        <input class="form-control" readonly="readonly" maxlength="30" type="text" name="tipo" id="tipo" value="@if(isset($objProduto->produto)){{$objProduto->produto->pro_tipo}}@endif" placeholder="Tipo" required="required">
                    </div>

                    <table class="data-table stripe hover nowrap dataTable no-footer dtr-inline table-dark" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                <tr role="row">
                                    <th class="table-plus datatable-nosort" rowspan="1" colspan="1" aria-label="Name">Tamanho</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Qtd Minima</th>
                                    <th class="table-plus datatable-nosort" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">Estoque</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row"  style="color: #000">
                                    <td class="table-plus sorting_1" tabindex="0">PP</td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[pp_min]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_minima_pp}}@endif" />
                                    </td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[pp_estoque]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_estoque_pp}}@endif"/>
                                    </td>
                                </tr>

                                <tr role="row"  style="color: #000">
                                    <td class="table-plus sorting_1" tabindex="0">P</td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                            <input type="number" min="0" max="9999" name="estoque[p_min]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_minima_p}}@endif"/>
                                        </td>

                                        <td class="table-plus sorting_1" tabindex="0">
                                            <input type="number" min="0" max="9999" name="estoque[p_estoque]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_estoque_p}}@endif"/>
                                        </td>
                                </tr>

                                <tr role="row"  style="color: #000">

                                    <td class="table-plus sorting_1" tabindex="0">M</td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[m_min]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_minima_m}}@endif"/>
                                    </td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[m_estoque]"  required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_estoque_m}}@endif"/>
                                    </td>
                                </tr>

                                <tr role="row"  style="color: #000">
                                    <td class="table-plus sorting_1" tabindex="0">G</td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[g_min]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_minima_g}}@endif"/>
                                    </td>


                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[g_estoque]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_estoque_g}}@endif"/>
                                    </td>

                                </tr>

                                <tr role="row"  style="color: #000">
                                    <td class="table-plus sorting_1" tabindex="0">GG</td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[gg_min]" required="required" value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_minima_gg}}@endif"/>
                                    </td>

                                    <td class="table-plus sorting_1" tabindex="0">
                                        <input type="number" min="0" max="9999" name="estoque[gg_estoque]" required="required"  value="@if(isset($objEstoqueProduto)){{$objEstoqueProduto->epr_qtd_estoque_gg}}@endif"/>
                                    </td>
                                </tr>

                            </tbody>
                    </table>

                    <div class="form-group">
                        <button type="button" class="btn btn-outline-dark btn-sm" onclick="voltar('/estoqueproduto/indexproduto')">Voltar</button>
                        <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


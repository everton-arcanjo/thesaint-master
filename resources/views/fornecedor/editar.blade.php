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
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                                    <li class="breadcrumb-item"><a href="/fornecedor" style="color: black">Relação de Fornecedores</a></li>
                                    <li class="breadcrumb-item active" aria-current="page" style="color: black;font-weight: bold">Alterar</li>
                                </ol>
                            </nav>
                        </div>

                    <form role="form" name="formFornecedor" action="/fornecedor/update/{{ $objFornecedor->for_id }}" method="post" style="margin-top: 20px">
                        @csrf
                        <div class="form-row">
                            <div class="form-group" style="margin-right: 20px">
                                <label>CNPJ</label> <span style="color: red">*</span>
                                <input class="form-control" maxlength="19" required="required" placeholder="CNPJ" name="fornecedor[cnpj]" id="fornecedorCnpj" value="{{ $objFornecedor->for_cnpj }}">
                            </div>
                            <div class="form-group" style="margin-right: 20px;width: 450px">
                                <label>Razão Social</label> <span style="color: red">*</span>
                                <input class="form-control"  maxlength="150" required="required" placeholder="Razão Social" name="fornecedor[razao_social]" id="fornecedorRazaoSocial" value="{{$objFornecedor->for_razao_social}}">
                            </div>
                            <div class="form-group" style="margin-right: 20px;width: 450px">
                                <label>Nome Fantasia</label>
                                <input class="form-control" maxlength="150" placeholder="Nome Fantasia" name="fornecedor[nome_fantasia]" id="fornecedorNomeFantasia" value="{{$objFornecedor->for_nome_fantasia}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group" style="margin-right: 20px;width: 300px">
                                <label>Contato</label>
                                <input class="form-control" maxlength="50" placeholder="Contato" name="fornecedor[contato]" id="fornecedorContato" value="{{$objFornecedor->for_contato}}">
                            </div>

                            <div class="form-group" style="margin-right: 20px">
                                <label>Telefone</label> <span style="color: red">*</span>
                                <input class="form-control" maxlength="18" required="required" placeholder="Telefone" name="fornecedor[telefone]" id="fornecedorTelefone" value="{{$objFornecedor->for_telefone}}">
                            </div>

                            <div class="form-group" style="margin-right: 20px">
                                <label>Celular</label>
                                <input class="form-control" maxlength="18" placeholder="Celular" name="fornecedor[celular]" id="fornecedorCelular" value="{{$objFornecedor->for_celular}}">
                            </div>

                            <div class="form-group" style="margin-right: 20px;width: 400px">
                                <label>E-mail</label>
                                <input class="form-control" maxlength="100" placeholder="E-mail" name="fornecedor[email]" id="fornecedorEmail" value="{{$objFornecedor->for_email}}">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-2">
                                <div class="form-group">
                                    <label>CEP:</label>
                                    <input class="form-control" maxlength="10" required="required" name="fornecedor[cep]" placeholder="CEP" id="fornecedorCep" value="@if(isset($objFornecedor->endereco)){{$objFornecedor->endereco->fen_cep}}@endif">
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="form-group">
                                    <label>Endereço:</label><span style="color: red">*</span>
                                    <input class="form-control" maxlength="80" required="required" name="fornecedor[endereco]" placeholder="Endereço" value="@if(isset($objFornecedor->endereco)){{$objFornecedor->endereco->fen_endereco}}@endif">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label>Número:</label> <span style="color: red">*</span>
                                    <input class="form-control" maxlength="5" required="required" placeholder="Número" id="fornecedorNumero" name="fornecedor[numero]" value="@if(isset($objFornecedor->endereco)){{$objFornecedor->endereco->fen_numero}}@endif">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Complemento:</label>
                                    <input class="form-control" maxlength="20" placeholder="Complemento" name="fornecedor[complemento]" value="@if(isset($objFornecedor->endereco)){{$objFornecedor->endereco->fen_complemento}}@endif">
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Bairro:</label>
                                    <input class="form-control" maxlength="30" name="fornecedor[bairro]" placeholder="Bairro" value="@if(isset($objFornecedor->endereco)){{$objFornecedor->endereco->fen_bairro}}@endif">
                                </div>
                            </div>

                            <div class="col-sm">
                                <div class="form-group">
                                    <label>Cidade:</label>
                                    <input class="form-control" maxlength="30" name="fornecedor[cidade]" placeholder="Cidade" value="@if(isset($objFornecedor->endereco)){{$objFornecedor->endereco->fen_cidade}}@endif">
                                </div>
                            </div>

                            <div class="col-1">
                                <div class="form-group">
                                    <label>Estado:</label>
                                    <input class="form-control" maxlength="2" id="fornecedorEstado" placeholder="Estado" name="fornecedor[estado]" value="@if(isset($objFornecedor->endereco)){{$objFornecedor->endereco->fen_estado}}@endif">
                                </div>
                            </div>
                        </div>

                        <br>
                        <button type="reset" class="btn btn-dark btn-sm" onclick="voltar('/fornecedor')">Voltar</button>
                        <button type="submit" class="btn btn-outline-dark btn-sm">Salvar</button>

                    </form>

            </div>
        </div>
    </div>


@endsection

@section('javascript')
<script src="{{ asset('js/fornecedor.js') }}" type="text/javascript"></script>
@endsection

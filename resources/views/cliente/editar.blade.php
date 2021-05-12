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
                        <li class="breadcrumb-item"><a href="/cliente" style="color: black">Relação de Clientes</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#" style="color: black;font-weight: bold">Alterar</a></li>
                    </ol>
                </nav>
            </div>

            <form role="form" name="formCliente" action="/cliente/update/{{ $objCliente->cli_id }}" method="post" style="margin-top: 20px">
                @csrf
                <div class="form-row">
                    <div class="form-group" style="margin-right: 20px">
                        <label>CNPJ</label> <span style="color: red">*</span>
                        <input class="form-control" maxlength="18" placeholder="CNPJ" name="cliente[cnpj]" id="clienteCnpj" value="{{$objCliente->cli_cnpj}}" required="required">
                    </div>
                    <div class="form-group" style="margin-right: 20px">
                        <label>Inscrição Estadual</label>
                        <input class="form-control" maxlength="15" placeholder="Inscrição Estadual" name="cliente[inscricao_estadual]" id="inscricaoEstadualCnpj" value="{{$objCliente->cli_inscricao_estadual}}">
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group" style="margin-right: 20px;width: 350px">
                        <label>Razão Social</label> <span style="color: red">*</span>
                        <input class="form-control" maxlength="150" placeholder="Razão Social" name="cliente[razao_social]" id="clienteRazaoSocial" value="{{$objCliente->cli_razao_social}}" required="required">
                    </div>

                    <div class="form-group" style="margin-right: 20px;width: 400px">
                        <label>Nome Fantasia</label> <span style="color: red">*</span>
                        <input class="form-control" maxlength="150" placeholder="Nome Fantasia" name="cliente[nome_fantasia]" id="clienteNomeFantasia" value="{{$objCliente->cli_nome_fantasia}}" required="required">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="margin-right: 20px;width: 300px">
                        <label>Contato</label> <span style="color: red">*</span>
                        <input class="form-control"  maxlength="50" placeholder="Contato" name="cliente[contato]" id="clienteContato" value="@if(isset($objCliente->contato)){{$objCliente->contato->cco_nome_contato}}@endif" required="required">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label>Telefone</label> <span style="color: red">*</span>
                        <input class="form-control" maxlength="18" placeholder="Telefone" name="cliente[telefone]" id="clienteTelefone" value="@if(isset($objCliente->contato)){{$objCliente->contato->cco_telefone_comercial}}@endif" required="required">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label>Celular</label>
                        <input class="form-control" maxlength="18" placeholder="Celular" name="cliente[celular]" id="clienteCelular" value="@if(isset($objCliente->contato)){{$objCliente->contato->cco_celular}}@endif" >
                    </div>

                    <div class="form-group" style="margin-right: 20px;width: 400px">
                        <label>E-mail</label> <span style="color: red">*</span>
                        <input class="form-control"  maxlength="50" placeholder="E-mail" name="cliente[email]" id="clienteEmail" value="@if(isset($objCliente->contato)){{$objCliente->contato->cco_email}}@endif" required="required">
                    </div>

                </div>


                <div class="row">

                    <div class="col-2">
                        <div class="form-group">
                            <label>CEP:</label> <span style="color: red">*</span>
                            <input class="form-control"  maxlength="15" name="cliente[cep]" placeholder="CEP" id="clienteCep" value="@if(isset($objCliente->endereco)){{$objCliente->endereco->cen_cep}}@endif" required="required">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="form-group">
                            <label>Endereço:</label> <span style="color: red">*</span>
                            <input class="form-control" maxlength="80" name="cliente[endereco]" placeholder="Endereço" value="@if(isset($objCliente->endereco)){{$objCliente->endereco->cen_endereco}}@endif" required="required">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Nº:</label> <span style="color: red">*</span>
                            <input class="form-control" maxlength="5" placeholder="Nº" id="clienteNumero" name="cliente[numero]" value="@if(isset($objCliente->endereco)){{$objCliente->endereco->cen_numero}}@endif" required="required">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm">
                        <div class="form-group">
                            <label>Complemento:</label>
                            <input class="form-control" maxlength="50" placeholder="Complemento" name="cliente[complemento]" value="@if(isset($objCliente->endereco)){{$objCliente->endereco->cen_complemento}}@endif">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input class="form-control" maxlength="30" name="cliente[bairro]" placeholder="Bairro" value="@if(isset($objCliente->endereco)){{$objCliente->endereco->cen_bairro}}@endif">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="form-group">
                            <label>Cidade:</label>
                            <input class="form-control" maxlength="30" name="cliente[cidade]" placeholder="Cidade" value="@if(isset($objCliente->endereco)){{$objCliente->endereco->cen_cidade}}@endif">
                        </div>
                    </div>

                    <div class="col-1">
                        <div class="form-group">
                            <label>Estado:</label>
                            <input class="form-control" maxlength="2" id="clienteEstado" placeholder="Estado" name="cliente[estado]" value="@if(isset($objCliente->endereco)){{$objCliente->endereco->cen_estado}}@endif">
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-outline-dark btn-sm" onclick="voltar('/cliente')">Voltar</button>
                    <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('js/cliente.js') }}" type="text/javascript"></script>
@endsection

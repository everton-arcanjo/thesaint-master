@extends('principal')
@section('conteudo')

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;">
        <div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
    <div class="min-height-200px">
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div style="border-bottom: 1px solid black">
                <nav aria-label="breadcrumb" role="navigation">
                     <ol class="breadcrumb" style="padding: 0px">
                         <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                         <li class="breadcrumb-item"><a href="/usuario" style="color: black">Relação de Usuários</a></li>
                         <li class="breadcrumb-item active" aria-current="page"><a href="#" style="color: black;font-weight: bold">Alterar</a></li>
                     </ol>
                 </nav>
             </div>

            <form role="form" name="formCliente" action="/usuario/update/{{$objUsuario->usu_id}}" method="post" style="margin-top: 20px">
                @csrf
                <div class="form-row">

                    <div class="form-group" style="margin-right: 20px;width: 20%">
                        <label>Departamento <span style="color: red">*</span></label>
                        <select  class="form-control" name="usuario[departamento]" id="usuarioDepartamento" required="required">
                            <option value="">Selecione</option>
                            @foreach ($listaDepartamento as $departamento)
                                <option @if($departamento->dep_id == $objUsuario->usu_dep_id) selected="selected" @endif value="{{$departamento->dep_id}}">{{$departamento->dep_nome}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="width: 50%">
                        <label>Nome</label> <span style="color: red">*</span>
                        <input type="text" class="form-control" maxlength="50" placeholder="Nome" name="usuario[nome]" id="usuarioNome" required="required" value="{{$objUsuario->usu_nome}}">
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group" style="margin-right: 20px">
                        <label>Telefone</label> <span style="color: red">*</span>
                        <input type="text" class="form-control" maxlength="18" placeholder="Telefone" name="usuario[telefone]" id="usuarioTelefone" value="{{$objUsuario->usu_telefone}}">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label>Celular</label> <span style="color: red">*</span>
                        <input type="text" class="form-control" maxlength="18" placeholder="Celular" name="usuario[celular]" id="usuarioCelular" value="{{$objUsuario->usu_celular}}">
                    </div>

                    <div class="form-group" style="margin-right: 20px;width: 400px">
                        <label>E-mail</label> <span style="color: red">*</span>
                        <input type="text" class="form-control"  maxlength="50" placeholder="E-mail" name="usuario[email]" id="usuarioEmail" required="required" value="{{$objUsuario->usu_email}}">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group" style="margin-right: 20px">
                        <label>Login</label> <span style="color: red">*</span>
                        <input type="text" class="form-control" maxlength="20" placeholder="Login" name="usuario[login]" id="usuarioLogin" required="required" value="{{$objUsuario->usu_login}}">
                    </div>

                    <div class="form-group" style="margin-right: 20px">
                        <label>Senha</label> <span style="color: red">*</span>
                        <input type="password" class="form-control" maxlength="20" placeholder="Senha" name="usuario[senha]" id="usuarioSenha" value="{{old('usuario.senha')}}">
                    </div>

                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-outline-dark btn-sm" onclick="voltar('/usuario')">Voltar</button>
                    <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('js/usuario.js') }}" type="text/javascript"></script>
@endsection

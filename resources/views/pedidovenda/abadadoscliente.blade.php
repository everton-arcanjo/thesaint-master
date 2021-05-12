<br/>
<div class="row">

    <div class="col-sm">
        <div class="form-group">
            <label>CNPJ</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" placeholder="CNPJ" id="pedidoClienteCnpj" name="cliente[cnpj]" placeholder="CNPJ" value="@if(isset($cliente)){{$cliente->cli_cnpj}}@endif" required="required">
            <input type="hidden" class="form-control" id="pedidoClienteId" name="cliente[cli_id]" value="@if(isset($cliente)){{$cliente->cli_id}}@endif">
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>Razão Social:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[razao_socia]" placeholder="Razão Social" value="@if(isset($cliente)){{$cliente->cli_razao_social}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Nome Fantasia:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[nome_fantasia]" placeholder="Nome Fantasia" value="@if(isset($cliente)){{$cliente->cli_nome_fantasia}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Inscrição Estadual:</label>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[inscricao_estadual]" placeholder="Inscrição Estadual" value="@if(isset($cliente)){{$cliente->cli_inscricao_estadual}}@endif">
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>Nome do Contato:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[contato]" placeholder="Nome do Contato" value="@if(isset($cliente)){{$cliente->contato->cco_nome_contato}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Telefone Comercial:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" placeholder="Telefone Comercial" id="pedidoClienteTelefone" name="cliente[telefone]" value="@if(isset($cliente)){{$cliente->contato->cco_telefone_comercial}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Celular:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" placeholder="Celular" id="pedidoClienteCelular" name="cliente[celular]" value="@if(isset($cliente)){{$cliente->contato->cco_celular}}@endif">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Email:</label> <span style="color: red">*</span>
            <input type="email" class="form-control"  onchange="validaAbaCliente()" placeholder="Email" name="cliente[email]" value="@if(isset($cliente)){{$cliente->contato->cco_email}}@endif" required="required">
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>CEP:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[cep]" placeholder="CEP" id="pedidoClienteCep" value="@if(isset($cliente)){{$cliente->endereco->cen_cep}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Endereço:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[endereco]" placeholder="Endereço" value="@if(isset($cliente)){{$cliente->endereco->cen_endereco}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Número:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" placeholder="Número" id="pedidoClienteNumero" name="cliente[numero]" required="required" value="@if(isset($cliente)){{$cliente->endereco->cen_numero}}@endif">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Complemento:</label>
            <input type="text" class="form-control" onchange="validaAbaCliente()" placeholder="Complemento" name="cliente[complemento]" value="@if(isset($cliente)){{$cliente->endereco->cen_complemento}}@endif">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm">
        <div class="form-group">
            <label>Bairro:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[bairro]" placeholder="Bairro" value="@if(isset($cliente)){{$cliente->endereco->cen_bairro}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Cidade:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" name="cliente[cidade]" placeholder="Cidade" value="@if(isset($cliente)){{$cliente->endereco->cen_cidade}}@endif" required="required">
        </div>
    </div>

    <div class="col-sm">
        <div class="form-group">
            <label>Estado:</label> <span style="color: red">*</span>
            <input type="text" class="form-control" onchange="validaAbaCliente()" placeholder="Estado" name="cliente[estado]" value="@if(isset($cliente)){{$cliente->endereco->cen_estado}}@endif" required="required">
        </div>
    </div>

</div>

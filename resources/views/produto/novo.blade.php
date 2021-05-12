@extends('principal')
@section('conteudo')
@detalheproduto()@enddetalheproduto


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
                                <li class="breadcrumb-item"><a href="/produto" style="color: black">Relação de Produtos</a></li>
                                <li class="breadcrumb-item active" aria-current="page" style="color: black;font-weight: bold">Cadastrar</li>
                            </ol>
                    </nav>
                </div>

                <form role="form" name="formProdutoFinal" action="/produto/store" method="post">
                    @csrf
                    <div id="msgUsuario"></div>
                    <div class="form-group">
                        <label>Tipo</label> <span style="color: red">*</span>
                        <input class="form-control"  placeholder="Tipo" name="tipo" required="required" value="">
                    </div>

                    <div class="row">
                    </div>
                    <a href="#" class="btn btn-outline btn-dark" id="adicionarCaracterisca" style="margin-bottom: 5px">Adicionar</a>

                    <table class="table" id="tabelaProdutoCaracteristica">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Codigo <span style="color: red">*</span></th>
                                <th scope="col">Molde <span style="color: red">*</span></th>
                                <th scope="col">Consumo <span style="color: red">*</span></th>
                                <th scope="col">Cor <span style="color: red">*</span></th>
                                <th scope="col">Tecido <span style="color: red">*</span></th>
                                <th scope="col">Valor <span style="color: red">*</span></th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                            <tbody></tbody>
                        </table>

                    <br>
                    <button type="reset" class="btn btn-dark btn-sm" onclick="voltar('/produto')">Voltar</button>
                    <button type="submit" class="btn btn-outline-dark btn-sm">Salvar</button>

                </form>

            </div>
        </div>
    </div>


@endsection

@section('javascript')
    <script src={{ asset('js/produto.js')}} type="text/javascript"></script>
@endsection

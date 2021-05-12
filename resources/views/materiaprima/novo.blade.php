@extends('principal')
@section('conteudo')
@estoquem()@endestoquem
@estoquem()@endestoquem

@forelse ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{$error}}
    </div>
    @empty
@endforelse

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/" style="color: black">Principal</a></li>
                            <li class="breadcrumb-item"><a href="/estoque" style="color: black">Estoque</a></li>
                            <li class="breadcrumb-item active" style="color: black;font-weight: bold" aria-current="page">Cadastrar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

            <form role="form" name="formMateriaPrima" action="/materiaprima/store" method="post">
                @csrf
                <div class="form-group">
                    <label>Tecido</label> <span style="color: red">*</span>
                    <select class="form-control" name="tecido" required="required">
                        <option value="">Selecione</option>
                        @foreach ($listaTecido as $tecido)
                            <option value="{{ $tecido->tec_id }}">{{ $tecido->tec_tecido }}</option>
                        @endforeach
                    <select>
                </div>

                <div class="form-group">
                    <label>Cor</label> <span style="color: red">*</span>
                    <select class="form-control" name="cor" required="required">
                        <option value="">Selecione</option>
                        @foreach ($listaCor as $cor)
                            <option value="{{ $cor->cor_id }}">{{ $cor->cor_cor }}</option>
                        @endforeach
                    <select>
                </div>

                <div class="form-group">
                    <label>Quantidade Minima Em Estoque</label> <span style="color: red">*</span>
                    <input type="text"  class="form-control" placeholder="Quantidade Minima Em Estoque" name="qtdMinimaEstoque" id="qtdMinimaEstoque" required="required" value="">
                </div>

                <button type="reset" class="btn btn-dark btn-sm" onclick="voltar('/estoque')">Voltar</button>
                <button type="submit" class="btn btn-outline-dark btn-sm">Salvar</button>
            </form>
        </div>
    </div>
</div>


@endsection

@section('javascript')
    <script src="{{ asset('js/materiaprima.js') }}" type="text/javascript"></script>
@endsection

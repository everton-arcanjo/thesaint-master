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
                                <li class="breadcrumb-item"><a href="/cor" style="color: black">Relação de Metas</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#" style="color: black;font-weight: bold">Cadastrar</a></li>
                            </ol>
                        </nav>
                    </div>

            <form name="formCor" action="/meta/store" method="post">
                @csrf
                <div class="form-row">
                        <div class="form-group">
                            <label>Vendedor</label> <span style="color: red">*</span>
                            <select class="form-control" name="meta[vendedor]" id="vendedor" required="required">
                                <option value="">Selecione</option>
                                @foreach ($listaVendedor as $vendedor)
                                    <option value="{{$vendedor->usu_id}}">{{$vendedor->usu_nome}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="form-row">
                    <div class="form-group" style="margin-right: 5px">
                        <label>Data Inicio</label> <span style="color: red">*</span>
                        <input class="form-control" type="date" name="meta[data_inicio]" id="dataInicio" required="required" value="{{old('meta.data_inicio')}}">
                    </div>

                    <div class="form-group">
                        <label>Data Fim</label> <span style="color: red">*</span>
                        <input class="form-control" type="date" name="meta[data_fim]" id="dataFim" required="required" value="{{old('meta.data_fim')}}">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>Valor Meta</label> <span style="color: red">*</span>
                        <input class="form-control" type="text" name="meta[valor_meta]" id="valorMeta" required="required" value="{{old('meta.valor_meta')}}">
                    </div>

                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-outline-dark btn-sm" onclick="voltar('/meta')">Voltar</button>
                    <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{asset('js/meta.js')}}" type="text/javascript"></script>
@endsection


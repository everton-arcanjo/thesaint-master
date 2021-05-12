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
                                    <li class="breadcrumb-item"><a href="/molde" style="color: black">Relação de Moldes</a></li>
                                    <li class="breadcrumb-item active" aria-current="page" style="color: black;font-weight: bold">Cadastrar</li>
                                </ol>
                            </nav>
                        </div>

                <form name="formCor" action="/molde/store" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Molde</label> <span style="color: red">*</span>
                        <input type="text" class="form-control"  maxlength="30" placeholder="Molde" name="molde" id="moldeMolde" required="required" value="{{old('molde')}}">
                    </div>

                    <div class="form-group">
                        <label>Unidade</label> <span style="color: red">*</span>
                            <select name="unidade" class="form-control" id="unidade" required="required">
                                <option value="">Selecione</option>
                                <option @if( old('unidade') == 'MT' ) selected="selected" @endif value="MT">Metros</option>
                                <option @if( old('unidade') == 'GR' ) selected="selected" @endif value="GR">Gramas</option>
                                <option @if( old('unidade') == 'KG' ) selected="selected" @endif value="KG">Kilo</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <label>Consumo</label> <span style="color: red">*</span>
                        <input type="text" class="form-control" placeholder="Consumo" name="consumo" id="moldeConsumo" required="required" value="{{old('consumo')}}">
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-outline-dark btn-sm" onclick="voltar('/molde')">Voltar</button>
                        <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{asset('js/molde.js')}}" type="javascript"></script>
@endsection

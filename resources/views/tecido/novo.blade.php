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
                            <li class="breadcrumb-item"><a href="/tecido" style="color: black">Relação de Tecidos</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: black;font-weight: bold">Cadastrar</li>
                        </ol>
                    </nav>
                </div>

                <form name="formTecido" action="/tecido/store" method="post" style="margin-top: 20px">
                    @csrf
                    <div class="form-group">
                        <label>Tecido</label> <span style="color: red">*</span>
                        <input type="text" class="form-control" maxlength="50" placeholder="Tecido" name="tecido" id="tecidoTecido" required="required" value="{{old('unidade')}}">
                    </div>

                    <div class="form-group">
                        <label>Unidade</label> <span style="color: red">*</span>
                        <select name="unidade" class="form-control" id="unidade" required="required">
                            <option value="">Selecione</option>
                            <option @if(old('unidade') == 'MT') selected="selected" @endif value="MT">Metros</option>
                            <option @if(old('unidade') == 'GR') selected="selected" @endif value="GR">Gramas</option>
                            <option @if(old('unidade') == 'KG') selected="selected" @endif value="KG">Kilo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="reset" class="btn btn-outline-dark btn-sm" onclick="voltar('/tecido')">Voltar</button>
                        <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


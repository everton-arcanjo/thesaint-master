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
                                        <li class="breadcrumb-item"><a href="/cor" style="color: black">Relação de Cores</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a href="#" style="color: black;font-weight: bold">Alterar</a></li>
                                    </ol>
                            </nav>
                        </div>

                <form role="form" name="formCor" action="/cor/update/{{ $objCor->cor_id }}" method="post" style="margin-top: 20px">
                    @csrf
                    <div class="form-group">
                        <label>Cor</label> <span style="color: red">*</span>
                        <input class="form-control"  maxlength="30" type="text" name="cor" id="cor" value="{{$objCor->cor_cor}}" placeholder="Cor" required="required">
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-outline-dark btn-sm" onclick="voltar('/cor')">Voltar</button>
                        <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


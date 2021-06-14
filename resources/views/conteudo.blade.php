@extends('principal')
@section('conteudo')

<div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10 mCustomScrollbar _mCS_3 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_3" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_3_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
        @if(Auth::user()->cli_dep_id == "1" || Auth::user()->cli_dep_id == "2")
            <div class="row clearfix progress-box">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                        <div class="project-info clearfix">
                            <div class="project-info-left">
                                <div class="icon box-shadow bg-blue text-white">
                                    <i class="far fa-eye"></i>
                                </div>
                            </div>
                            <div class="project-info-right">
                                <span class="no text-blue weight-500 font-24">{{$totalPedidoAguardando}}</span>
                                <p class="weight-400 font-18">Pedidos Aguardando Aprovacao [@php echo date("m/Y") @endphp]</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                        <div class="project-info clearfix">
                            <div class="project-info-left">
                                <div class="icon box-shadow bg-light-orange text-white">
                                    <i class="fas fa-thumbs-down"></i>
                                </div>
                            </div>
                            <div class="project-info-right">
                                <span class="no text-light-orange weight-500 font-24">{{$totalPedidoRecusado}}</span>
                                <p class="weight-400 font-18">Pedidos Recusado [@php echo date("m/Y") @endphp]</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                        <div class="project-info clearfix">
                            <div class="project-info-left">
                                <div class="icon box-shadow bg-light-green text-white">
                                    <i class="fas fa-thumbs-up"></i>
                                </div>
                            </div>
                            <div class="project-info-right">
                                <span class="no text-light-green weight-500 font-24">{{$totalPedidoAprovado}}</span>
                                <p class="weight-400 font-18">Pedidos Aprovados [@php echo date("m/Y") @endphp]</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="bg-white pd-20 box-shadow border-radius-5 margin-5 height-100-p">
                        <div class="project-info clearfix">
                            <div class="project-info-left">
                                <div class="icon box-shadow bg-light-purple text-white">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <div class="project-info-right">
                                <span class="no text-light-purple weight-500 font-24">R$ {{$valorFafurado}}</span>
                                <p class="weight-400 font-18">Bruto Faturado  [@php echo date("m/Y") @endphp]</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @else
        <div class="row clearfix progress-box">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                    <div class="bg-white pd-20 box-shadow border-radius-5 margin-5 height-100-p">
                        <div class="project-info clearfix">
                            <div class="project-info-left">
                                <div class="icon box-shadow bg-light-purple text-white">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <div class="project-info-right">
                                <span class="no text-light-purple weight-500 font-24">R$ {{number_format($metaVendedorLogado,2,",",".")}}</span>
                                <p class="weight-400 font-18">Minha Meta  [@php echo date("m/Y") @endphp]</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                        <div class="bg-white pd-20 box-shadow border-radius-5 margin-5 height-100-p">
                            <div class="project-info clearfix">
                                <div class="project-info-left">
                                    <div class="icon box-shadow bg-light-purple text-white">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                                <div class="project-info-right">
                                    <span class="no text-light-purple weight-500 font-24">R$ {{number_format($metaVendedorLogado,2,",",".")}}</span>
                                    <p class="weight-400 font-18">Total Vendido  [@php echo date("m/Y") @endphp]</p>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        @endif

        @if(Auth::user()->cli_dep_id == "1" || Auth::user()->cli_dep_id == "2")
            <div class="bg-white pd-20 box-shadow border-radius-5 mb-30">
                <h4 class="mb-30">Ranking de Vendas REF @php echo date("m/Y") @endphp</h4>
                <div class="row">
                    <div id="poll_div" style="width: 100%;height:60%;padding-right: 50px"></div>
                   @if(isset($lava))
                        {!! $lava->render('BarChart', 'Votes', 'poll_div'); !!}
                    @else
                        <h6 class="mb-30">Não existem dados para serem exibidos</h6>
                   @endif
                </div>
            </div>
        @else
            <div class="bg-white pd-20 box-shadow border-radius-5 mb-30">
                <h4 class="mb-30">Minhas Vendas Mensais [GRAFICO]</h4>
                <div class="row">
                    <div id="poll_div" style="width: 100%;height:60%;padding-right: 50px"></div>
                   @if(isset($lava))
                        {!! $lava->render('ColumnChart', 'Finances', 'poll_div'); !!}
                    @else
                        <h6 class="mb-30">Não existem dados para serem exibidos</h6>
                   @endif
                </div>
            </div>
        @endif

</div>
</div>

<div id="mCSB_3_scrollbar_vertical" class="mCSB_scrollTools mCSB_3_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_3_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 121px; max-height: 446.4px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div>
@endsection

@section('javascript')

@endsection




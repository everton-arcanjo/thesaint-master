{{estoqueBaixo()}}
<div class="header clearfix">
        <div class="header-right">
                <div class="brand-logo">
                    <a href="/">
                        <img src="#" alt="" class="mobile-logo">
                    </a>
                </div>
                <div class="menu-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="user-info-dropdown">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            <span class="user-icon"><i class="fa fa-user-o"></i></span>
                            <span class="user-name">{{auth()->user()->usu_nome}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!--<a class="dropdown-item" href="/"><i class="fa fa-user-md" aria-hidden="true"></i>Pefil</a>
                            <a class="dropdown-item" href="/"><i class="fa fa-cog" aria-hidden="true"></i>Configurações</a>
                            <a class="dropdown-item" href="/"><i class="fa fa-question" aria-hidden="true"></i>Ajuda</a>-->
                            <a class="dropdown-item" href="{{ route('sair') }}"><i class="fa fa-sign-out" aria-hidden="true"></i>Sair</a>
                        </div>
                    </div>
                </div>

                <div class="user-notification">
                    <div class="dropdown">
                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            @if(estoqueBaixo() >= "1" || estoqueBaixoProduto() >= "1")
                                <span class="badge notification-active"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="notification-list mx-h-350 customscroll mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar" style="position: relative; overflow: visible;">
                                <div id="mCSB_1_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                                        <ul>
                                            @if(estoqueBaixo() >= "1")
                                                 <li>
                                                    <a href="/estoque">
                                                        <h3 class="clearfix">Estoque Baixo Tecido</h3>
                                                        <p>Atenção você precisa efetuar uma nova compra de um dos seus tecidos</p>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(estoqueBaixoProduto() >= "1")
                                            <li>
                                               <a href="/estoqueproduto/indexproduto">
                                                   <h3 class="clearfix">Estoque Baixo Produto</h3>
                                                   <p>Atenção você precisa efetuar uma nova compra de um dos seus produtos</p>
                                               </a>
                                           </li>
                                       @endif

                                        </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>
    <div class="left-side-bar">
            <div class="brand-logo">
                <a href="/">
                    <img src="{{asset('img/logo_the_saint.png')}}" alt="">
                </a>
            </div>
            <div class="menu-block customscroll mCustomScrollbar _mCS_2 mCS-autoHide" style="position: relative; overflow: visible;border-right: solid 1px #000 ">
                <div id="mCSB_2" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;">
                    <div id="mCSB_2_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">

                <div class="sidebar-menu">
                        <ul class="submenu" style="display: block;">
                            @foreach (menu() as $funcionalidade)
                                <li style="background-color: #FFF" class="dropdown">
                                    <a href="{{$funcionalidade->mnu_link}}">
                                        <i style="margin-right: 15px" class="{{$funcionalidade->mnu_icone}}"></i>
                                        {{$funcionalidade->mnu_nome}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
       </div>
        </div>





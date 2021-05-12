<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>The Saint</title>
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('js/plugins/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('js/plugins/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('js/plugins/datatables/media/css/responsive.dataTables.css') }}" rel="stylesheet" type="text/css"/>
    </head>
        <body>
            <div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20 mCustomScrollbar _mCS_1 mCS-autoHide" style="position: relative; overflow: visible;">
                <div id="mCSB_1" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" style="max-height: 510.4px;" tabindex="0">
                    <div id="mCSB_1_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
                        <div class="login-box bg-white box-shadow pd-30 border-radius-5">
                            <img src="{{ asset('img/logo_the_saint.png') }}" alt="login" class="login-img mCS_img_loaded">
                            <h2 class="text-center mb-30">Login</h2>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group custom input-group-lg">
                                    <input type="text" class="form-control{{ $errors->has('usu_login') ? ' is-invalid' : '' }}"  placeholder="Login" name="usu_login" value="{{ old('usu_login') }}" required="required" autofocus>
                                    @if ($errors->has('usu_login'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('usu_login') }}</strong>
                                        </span>
                                    @endif
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="input-group custom input-group-lg">
                                    <input type="password" class="form-control{{ $errors->has('usu_senha') ? ' is-invalid' : '' }}" placeholder="Senha" name="usu_senha" value="{{old('usu_senha')}}"  required="required">
                                    @if ($errors->has('usu_senha'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('usu_senha') }}</strong>
                                        </span>
                                    @endif
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-outline-dark btn-lg btn-block">Acessar</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- <div class="forgot-password padding-top-10"><a href="#">Esqueci minha senha</a></div>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>

            <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/functions.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/jquery.mask.js') }}" type="text/javascript"></script>

            <script src="{{ asset('js/plugins/datatables/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/dataTables.responsive.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/responsive.bootstrap4.js') }}" type="text/javascript"></script>

            <!-- buttons for Export datatable -->
            <script src="{{ asset('js/plugins/datatables/media/js/button/dataTables.buttons.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/button/buttons.bootstrap4.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/button/buttons.print.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/button/buttons.html5.js') }}" type="text/javascript"></script>

            <script src="{{ asset('js/plugins/datatables/media/js/button/buttons.flash.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/button/pdfmake.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('js/plugins/datatables/media/js/button/vfs_fonts.js') }}" type="text/javascript"></script>

            @hasSection ('javascript')
             @yield('javascript')
            @endif
        </body>
    </html>

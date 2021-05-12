<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>The Saint</title>
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('js/plugins/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('js/plugins/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('js/plugins/datatables/media/css/responsive.dataTables.css') }}" rel="stylesheet" type="text/css"/>

    </head>
        <body>
            @menu()@endmenu
            <div class="main-container">
                @yield('conteudo')
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

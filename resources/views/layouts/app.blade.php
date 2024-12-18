<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- Begin Head -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>2 Parts | Admin Dashboard </title>
    <link rel="shortcut icon" href="{{ asset('img/favicon (1).ico') }}" />
    <!-- Styles -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="http://administration.2-parts.gr/css/app.css" rel="stylesheet">
    <link href="http://administration.2-parts.gr/css/all.css" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-line-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-switch.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/darkblue.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css//login-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script> -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/keytable/2.3.2/css/keyTable.dataTables.min.css" rel="stylesheet" />
    <link href="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.css" rel="stylesheet" type="text/css">
    <script>
        setTimeout(() => {
            $('.dropdown-toggle').dropdown()
        }, 1000);
    </script>
    <style>
        tr.odd.redRow td {
            background-color: RGB(237, 82, 73);
            color: #fff;
        }

        tr.odd.redRow:hover td {
            color: #000;
        }

        table {
            border-collapse: collapse;
        }

        td {
            position: relative;
            padding: 5px 10px;
        }

        tr.strikeout td:before {
            content: " ";
            position: absolute;
            top: 50%;
            left: 0;
            border-bottom: 1px solid #111;
            width: 100%;
        }
    </style>
</head>
<!-- End Head -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
        <div id="app5" class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                   @include('includes.logo')
                    <!-- END LOGO -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                   @if( \Request::route()->getName() != 'register') 
                        @include('includes.minimenu')
                   @endif
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                @include('includes.sidebar')
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGINATION -->
                        @include('includes.breadcrumps')
                        <!-- END PAGINATION -->
                        <!-- BEGIN PAGE TITLE-->
                        @include('includes.title')
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <!-- BEGIN PAGE CONTENT -->
                        <div class="container-fluid">
                        @yield('content')
                        </div>
                        <!-- END PAGE CONTENT -->
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->
                @include('includes.quick_sidebar')
                <!-- END QUICK SIDEBAR -->
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            @include('includes.footer')
            <!-- END FOOTER -->
        </div>
        @include('includes.quicknav')
        <!-- BEGIN QUICK NAV -->
        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
    <!-- Scripts -->
    <script>
        window.laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
    <<style>
        .vm--modal {
            overflow: scroll !important;
        }
    </style>
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js" type="text/javascript"></script>    
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js" type="text/javascript"></script>    
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js" type="text/javascript"></script>    
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.colVis.min.js" type="text/javascript"></script>    
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js" type="text/javascript"></script>    
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>    
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/keytable/2.3.2/js/dataTables.keyTable.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.54/pdfmake.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.54/vfs_fonts.js"></script>
    <script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.contextMenu.js" type="text/javascript"></script>
    <script src="https://swisnl.github.io/jQuery-contextMenu/dist/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/app-metronic.js') }}"></script>
    {{-- <script src="{{ asset('js/pdfmake.min.js') }}"></script> --}}
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    {{-- <script src="{{ asset('js/moment-with-locales.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> --}}
    <script src="{{ asset('js/locale_gr_datepicker.js') }}"></script>
    <script src="{{ asset('js/js.cookie.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('js/demo.min.js') }}"></script>
    <script src="{{ asset('js/quick-nav.min.js') }}"></script>
    <script src="{{ asset('js/quick-sidebar.min.js') }}"></script>
    <script src="{{ asset('js/layout.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    {{-- <script src="{{ asset('js/vfs_fonts.js') }}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

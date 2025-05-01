<!DOCTYPE html>
<html>

    {{-- Head Begins --}}
    {{-- We reference all css stylesheet within Head--}}

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        {{-- Title, basically thing that is displayed on top of browser tab --}}
        <title>
            NTA
        </title>  
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        {{-- Tell the browser to be responsive to screen width --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="{{asset('./adminlte3/plugins/fontawesome-free/css/all.min.css')}}">

        {{-- Ionicons --}}
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        {{-- Tempusdominus Bbootstrap 4 --}}
        <link rel="stylesheet"
            href="{{asset('./adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

        {{-- iCheck --}}
        <link rel="stylesheet" href="{{asset('./adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">


        {{-- Theme style --}}
        <link rel="stylesheet" href="{{asset('./adminlte3/dist/css/adminlte.min.css')}}">

        {{-- overlayScrollbars --}}
        <link rel="stylesheet" href="{{asset('./adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

        {{-- Google Font: Source Sans Pro --}}
        <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">

        {{-- Ajax and databales/ Bootstarp components --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{--select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    </script>

        {{-- Completion of head --}}
    </head>

    {{-- Start of Body --}}

    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">

            @include('layouts.navbar')

            @include('layouts.sidebar')
        </div>
        <div class="content-wrapper mt-5" style="background-color: 	#f8fafc;">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        @include('layouts.footer')
       
        <!-- jQuery -->
        <script src="{{url('./adminlte3/plugins/jquery/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{url('./adminlte3/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{url('./adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- ChartJS -->
        <script src="{{url('./adminlte3/plugins/chart.js/Chart.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{url('./adminlte3/plugins/sparklines/sparkline.js')}}"></script>


        <!-- overlayScrollbars -->
        <script src="{{url('./adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{url('./adminlte3/dist/js/adminlte.js')}}"></script>
        {{-- Rest of scripts from individual page --}}
        {{-- Datatables --}}
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
        </script>
        <!-- select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @yield('scripts')
    </body>

</html>

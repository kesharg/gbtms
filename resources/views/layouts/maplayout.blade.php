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
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        {{-- Tell the browser to be responsive to screen width --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Font Awesome --}}
        <link rel="stylesheet" href="{{asset('./adminlte3/plugins/fontawesome-free/css/all.min.css')}}">

        {{-- Ionicons --}}
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        {{-- Tempusdominus Bbootstrap 4 --}}
        <link rel="stylesheet"
            href="{{asset('./adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">


        {{-- Theme style --}}
        <link rel="stylesheet" href="{{asset('./adminlte3/dist/css/adminlte.min.css')}}">

        {{-- overlayScrollbars --}}
        <link rel="stylesheet" href="{{asset('./adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">



        {{-- Google Font: Source Sans Pro --}}
        <link href="https://fonts.googleapis.com/css?family=Baloo+2&display=swap" rel="stylesheet">

        </script>
        @yield('header')
        {{-- Completion of head --}}
    </head>

    {{-- Start of Body --}}

    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">

            @include('layouts.sidebar')
            @yield('content')

        @include('layouts.footer')
        </div>


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
        <script type="text/javascript">
            var GEO_URL = "<?php echo Config::get('geo.GEO_URL');?>";
            var GEO_AUTHKEY ="<?php echo Config::get('geo.GEO_AUTHKEY');?>";
            var GEO_WORKSPACE = "<?php echo Config::get('geo.GEO_WORKSPACE') ;?>";
        </script>
        <script type="module" src="{{ url('./js/mapmain.js') }}"></script>

        </script>
        <script type="text/javascript">
            var APP_URL = {!! json_encode(url('/')) !!}
        </script>

    </body>

</html>

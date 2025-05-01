<!DOCTYPE html>
<html>

    {{-- Head Begins --}}
    {{-- We reference all css stylesheet within Head--}}

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        {{-- Title, basically thing that is displayed on top of browser tab --}}
        <title>
            NTA | Log In
        </title>

        {{-- Tell the browser to be responsive to screen width --}}
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
        </script>
        {{-- Completion of head --}}
    </head>

    {{-- Start of Body --}}
    <style>
        body,
        html {
            height: 100%;
        }

        .bg {
            height: 100%;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #81D4FA;
            color: white;
            height: 30px;
            font-size: 18px;
            text-align: center;
        }
    </style>

    <body class="bg"
        style="background-image:linear-gradient(rgba(255, 255, 255, .6), rgba(255, 255, 255, .6)),url({{url('./img/login_background.jpg')}})">
        <div class="login-logo"><img src="{{url('./img/logo.png')}}" style="height:200px;">

        </div>
        <div class="login-logo" style="font-size: 40px;"><b>Nepal Telecommunication Authority</b>

        </div>
        <div class="login-logo" style="font-size: 25px;"><b>GIS BASED TELECOMMUNICATION INFRASTRUCTURE MANAGEMENT
                INFORMATION
                SYSTEM</b>

        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" align="center">Enter your credentials to login</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="#" data-toggle="modal"
                                            data-target="#errorModal">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                        </button>


                                    </div>
                                </div>
                            </form>
                            <!-- Modal -->
                            <div class="modal fade" id="errorModal" tabindex="-1" role="dialog"
                                aria-labelledby="errorModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="errorModalLabel">Please Contact Respective
                                                Authority
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Sorry, passwords can be reset by administration only!
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">OK</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="float-left d-none d-sm-inline-block ml-4">
                    <strong>Copyright &copy; {{ date("Y") }} <a target="_blank" href="{{ env('NTA_URL') }}">NTA</a></strong> &nbsp;All
                    rights
                    reserved</div>
                <div class="d-sm-inline-block mr-5">
                    <b>Version </b>{{env('VERSION')  }}

                </div>
                <div class="float-right d-none d-sm-inline-block mr-4">
                    <b>Developed By:</b>
                    <a target="_blank" href="{{ env('INSOL_URL') }}">Innovative Solution Pvt. Ltd.
                    </a>
                </div>
            </footer>
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
        {{-- Rest of scripts from individual page --}}
        {{-- Datatables --}}
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
        </script>

    </body>


</html>
